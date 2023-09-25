<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Opportunity;
use App\Models\OpportunityUser;
use App\Models\VideoInterview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class OpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listAnnouncedJobs(Request $request)
    {

        $search = $request->query('search');

        $opportunities = Opportunity::withCount('appliedUsers')
            ->where('company_id', auth()->user()->company->id)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        //preserve search query
        $opportunities->appends(['search' => $search]);


        return Inertia::render('Company/ListAnnouncedJobs',
            [
                'opportunities' => $opportunities,
            ]
        );
    }

    public function opportunityReport(Opportunity $opportunity)
    {

        $opportunity
            ->loadCount('appliedUsers')
            ->load('address')
            ->load('company');

        $countByGender = OpportunityUser::query()
            ->select('genders.label', DB::raw('count(*) as total'))
            ->join('users', 'users.id', '=', 'opportunity_user.user_id')
            ->join('user_personal_data as t3', 't3.user_id', '=', 'users.id')
            ->join('genders', 'genders.id', '=', 't3.gender_id')
            ->where('opportunity_user.opportunity_id', $opportunity->id)
            ->groupBy('genders.label')
            ->get()
            ->toArray();

        $countByState = OpportunityUser::query()
            ->select('user_addresses.state as label', DB::raw('count(*) as total'))
            ->join('users', 'users.id', '=', 'opportunity_user.user_id')
            ->join('user_addresses', 'user_addresses.user_id', '=', 'users.id')
            ->where('opportunity_user.opportunity_id', $opportunity->id)
            ->groupBy('user_addresses.state')
            ->get()
            ->toArray();

        $countByAge = OpportunityUser::query()
            ->select(DB::raw('YEAR(CURDATE()) - YEAR(users.birth_date) - IF(DAYOFYEAR(CURDATE()) < DAYOFYEAR(users.birth_date), 1, 0) as label'), DB::raw('count(*) as total'))
            ->join('users', 'users.id', '=', 'opportunity_user.user_id')
            ->where('opportunity_user.opportunity_id', $opportunity->id)
            ->groupBy('label')
            ->get()
            ->toArray();

        $countByDeficiency = OpportunityUser::query()
            ->select('deficiencies.deficiency as label', DB::raw('count(*) as total'))
            ->join('users', 'users.id', '=', 'opportunity_user.user_id')
            ->join('user_deficiency', 'user_deficiency.user_id', '=', 'users.id')
            ->join('deficiencies', 'deficiencies.id', '=', 'user_deficiency.deficiency_id')
            ->where('opportunity_user.opportunity_id', $opportunity->id)
            ->groupBy('deficiencies.deficiency')
            ->get()
            ->toArray();

        return Inertia::render('Company/OpportunityReport',
            [
                'opportunity' => $opportunity,
                'countByGender' => $countByGender,
                'countByState' => $countByState,
                'countByAge' => $countByAge,
                'countByDeficiency' => $countByDeficiency,
            ]
        );
    }

    public function opportunityShow(Opportunity $opportunity)
    {

        $opportunity
            ->load('address')
            ->load('company')
            ->load('targetUsers');

        $opportunityUser = $opportunity->appliedUsers()
            ->where('user_id', auth()->user()->id)
            ->get();

        $hasApplied = $opportunityUser->count() > 0 ? true : false;

        if(!$hasApplied){
            //increase views
            $opportunity->views = $opportunity->views + 1;
            $opportunity->save();
        }

        if($hasApplied){
            $opportunityUser = $opportunityUser->first();

            $opportunityUser->pivot->interviews = $opportunityUser->pivot->interview()->get();
            $opportunityUser->pivot->videoInterviews = $opportunityUser->pivot->videoInterview()->get();

            $oportunitySimpleSteps = $opportunity
                ->simpleSteps()
                ->select('id', 'name', 'description', 'order')
                ->get();

            $oportunityVideoSteps = $opportunity
                ->videoSteps()
                ->select('id', 'name', 'description', 'order', 'limit_days')
                ->get();

            $oportunityInterviewSteps = $opportunity
                ->interviewSteps()
                ->select('id', 'name', 'description', 'order')
                ->get();

            $oportunityTestSteps = $opportunity
                ->testSteps()
                ->select('id', 'name', 'description', 'order', 'link', 'limit_days')
                ->get();

            //add type to each step
            $oportunitySimpleSteps->map(function($step){
                $step->type = 'SimpleInterviewStepCard';
                return $step;
            });

            $oportunityVideoSteps->map(function($step){
                $step->type = 'VideoInterviewStepCard';
                return $step;
            });

            $oportunityInterviewSteps->map(function($step){
                $step->type = 'InterviewStepCard';
                return $step;
            });

            $oportunityTestSteps->map(function($step){
                $step->type = 'TestInterviewStepCard';
                return $step;
            });

            //transform all steps in one array and order by order
            $steps = collect($oportunitySimpleSteps->toArray())
                ->merge($oportunityVideoSteps->toArray())
                ->merge($oportunityInterviewSteps->toArray())
                ->merge($oportunityTestSteps->toArray())
                ->sortBy('order')
                ->values()
                ->toArray();
        }

        return Inertia::render('Opportunity/Show',[
            'opportunity' => $opportunity,
            'hasApplied' => $hasApplied,
            'opportunityUser' => $opportunityUser,
            'opportunitySteps' => $steps ?? null,
        ]);

    }

    public function nextStep(Request $request)
    {

        $opportunityUser = OpportunityUser::find($request->opportunityUser);

        $opportunityUser->current_step = $opportunityUser->current_step + 1;

        $opportunityUser->save();

        return back()->with('success', 'Candidato passou de etapa!');
    }

    public function backStep(Request $request)
    {

        $opportunityUser = OpportunityUser::find($request->opportunityUser);

        $opportunityUser->current_step = $opportunityUser->current_step - 1;

        $opportunityUser->save();

        return back()->with('success', 'Candidato retornou uma etapa!');
    }

    public function updateCandidateStatus(Request $request){
            
        $opportunityUser = OpportunityUser::find($request->opportunityUser);

        $opportunityUser->status = $request->status;

        $opportunityUser->save();

        return back()->with('success', 'Status do candidato atualizado!');
    }

    public function setInterviewDate(Request $request){

        $interview = Interview::updateOrCreate(
            [
                'opportunity_user_id' => $request->opportunityUser,
                'interview_step_id' => $request->step,
            ],
            [
                'date' => date('Y-m-d H:i:s', strtotime($request->date))
            ]);

        return back()->with('success', 'Data da entrevista atualizada!');
    }

    public function setVideoInterview(Request $request){

        $filename = uniqid(). '.' . $request->file->extension();
        $path = $request->file->storeAs("videos", $filename);
            
        $interview = VideoInterview::updateOrCreate(
            [
                'opportunity_user_id' => $request->opportunityUser,
                'video_step_id' => $request->step,
            ],
            [
                'video_url' => $path
            ]);

        return back()->with('success', 'Video atualizado!');
    }

    public function downloadVideoInterview($video){

        $video = VideoInterview::find($video);

        return response()->download(storage_path('app/'.$video->video_url));
    }

    public function appliedUsers(Opportunity $opportunity, Request $request)
    {

        $search = $request->query('search');

        $appliedUsers = $opportunity
            ->appliedUsers()
            ->with('address')
            ->paginate(9);

        //get all interviews of the applied user
        $appliedUsers->map(function($user) use ($opportunity){
            
            // dd($opportunity, $user->pivot);
            $user->pivot->interviews = $user->pivot->interview()
                ->where('opportunity_user_id', $user->pivot->id)
                ->get();

            $user->pivot->videoInterviews = $user->pivot->videoInterview()
                ->where('opportunity_user_id', $user->pivot->id)
                ->get();
                
            return $user;
        });
        
        $oportunitySimpleSteps = $opportunity
            ->simpleSteps()
            ->select('id', 'name', 'description', 'order')
            ->get();

        $oportunityVideoSteps = $opportunity
            ->videoSteps()
            ->select('id', 'name', 'description', 'order')
            ->get();

        $oportunityInterviewSteps = $opportunity
            ->interviewSteps()
            ->select('id', 'name', 'description', 'order')
            ->get();

        $oportunityTestSteps = $opportunity
            ->testSteps()
            ->select('id', 'name', 'description', 'order')
            ->get();

        //add type to each step
        $oportunitySimpleSteps->map(function($step){
            $step->type = 'SimpleInterviewStepCard';
            return $step;
        });

        $oportunityVideoSteps->map(function($step){
            $step->type = 'VideoInterviewStepCard';
            return $step;
        });

        $oportunityInterviewSteps->map(function($step){
            $step->type = 'InterviewStepCard';
            return $step;
        });

        $oportunityTestSteps->map(function($step){
            $step->type = 'TestInterviewStepCard';
            return $step;
        });

        //transform all steps in one array and order by order
        $steps = collect($oportunitySimpleSteps->toArray())
            ->merge($oportunityVideoSteps->toArray())
            ->merge($oportunityInterviewSteps->toArray())
            ->merge($oportunityTestSteps->toArray())
            ->sortBy('order')
            ->values()
            ->toArray();

        return Inertia::render('Company/CandidateList',
            [
                'opportunity' => $opportunity,
                'opportunitySteps' => $steps,
                'appliedUsers' => $appliedUsers,
            ]
        );
    }

    public function showAllOpportunities(Request $request){

        $search = $request->query('search');

        $opportunities = Opportunity::withCount('appliedUsers')
            ->with('address')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->where('status', 'Aberta')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        //preserve search query
        $opportunities->appends(['search' => $search]);

        return Inertia::render('Opportunity/List',[
            'opportunities' => $opportunities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'resume' => 'required|string|max:255',
            'regime' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'workHour_start' => 'required|string|max:255',
            'workHour_end' => 'required|string|max:255',
            'salary_start' => 'required|string|max:255',
            'salary_end' => 'required|string|max:255',
            'pcd' => 'required|boolean',
            'quantity' => 'required|integer',
            'benefits' => 'required|string|max:255',
            'skills' => 'required|string|max:255',
            'requisites' => 'required|string|max:255',
            'responsabilities' => 'required|string|max:255',
            'remote' => 'required|boolean',
            'cep' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'neighbor' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'targetUsers' => 'array',
            'processSteps' => 'required|array',
            'processSteps.*.type' => 'required|string|max:255',
            'processSteps.*.name' => 'required|string|max:255',
            'processSteps.*.description' => 'required|string|max:255',
        ]);
    
        //remove mask from salary
        $request->merge([
            "salary_start" => str_replace( ['.', ','], ['','.'], $request->salary_start),
            "salary_end" => str_replace( ['.', ','], ['','.'], $request->salary_end),
        ]);
    
        DB::transaction(function () use ($request){
    
            //create opportunity
    
            $opportunity = \App\Models\Opportunity::create([
                'name' => $request->name,
                'role' => $request->role,
                'resume' => $request->resume,
                'hiring_regime' => $request->regime,
                'job_type' => $request->type,
                'work_start' => $request->workHour_start,
                'work_end' => $request->workHour_end,
                'salary_start' => $request->salary_start,
                'salary_end' => $request->salary_end,
                'is_pcd' => $request->pcd,
                'vacancies' => $request->quantity,
                'benefits' => $request->benefits,
                'competences' => $request->skills,
                'requirements' => $request->requisites,
                'responsabilities' => $request->responsabilities,
                'is_remote' => $request->remote,
                'status' => 'Aberta',
                'company_id' => auth()->user()->company->id,
            ]);
    
            //create address
    
            $opportunity->address()->create([
                'cep' => $request->cep,
                'street' => $request->street,
                'neighborhood' => $request->neighbor,
                'state' => $request->state,
                'city' => $request->city,
                'number' => $request->number,
            ]);
    
            //create target users
            if($request->targetUsers){
                $opportunity->targetUsers()->attach($request->targetUsers);
            }
    
            //create steps
    
            foreach($request->processSteps as $key => $step){
                
                if($step["type"] == 'Simples'){
                    $opportunity->simpleSteps()->create([
                        'name' => $step["name"],
                        'description' => $step["description"],
                        'order' => $key,
                    ]);
                    
                }
    
                if($step["type"] == 'Video'){
                    $opportunity->videoSteps()->create([
                        'name' => $step["name"],
                        'description' => $step["description"],
                        'order' => $key,
                        'limit_days' => $step["limitDate"],
                    ]);
                    
                }
    
                if($step["type"] == 'Entrevista'){
                    $opportunity->interviewSteps()->create([
                        'name' => $step["name"],
                        'description' => $step["description"],
                        'order' => $key,
                    ]);
                    
                }
    
                if($step["type"] == 'Teste'){
                    $opportunity->testSteps()->create([
                        'name' => $step["name"],
                        'description' => $step["description"],
                        'order' => $key,
                        'limit_days' => $step["limitDate"],
                    ]);
                    
                }
    
            }
        });
        
        return redirect()->route('company.announced');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Opportunity $opportunity)
    {

        $deficiences = \App\Models\Deficiency::all();

        $opportunity
            ->load('address');

        //load the target users as an array of only ids
        $opportunity->targetUsers = $opportunity->targetUsers->pluck('id')->toArray();

        return Inertia::render('Opportunity/Edit', [
            'deficiences' => $deficiences,
            'opportunity' => $opportunity,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePart1(Request $request, Opportunity $opportunity)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'resume' => 'required|string|max:255',
            'regime' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'workHour_start' => 'required|string|max:255',
            'workHour_end' => 'required|string|max:255',
            'salary_start' => 'required|string|max:255',
            'salary_end' => 'required|string|max:255',
            'pcd' => 'required|boolean',
            'quantity' => 'required|integer',
            'targetUsers' => 'array',
        ]);

        $update = $request->all();

        $update["salary_start"] = str_replace( ['.', ','], ['','.'], $request->salary_start);
        $update["salary_end"] = str_replace( ['.', ','], ['','.'], $request->salary_end);

        $targetUsers = $request->targetUsers;

        unset($update["targetUsers"]);

        DB::transaction(function () use ($opportunity, $update, $targetUsers){

            $opportunity->update($update);

            //update target users
            $opportunity->targetUsers()->sync($targetUsers);

        });

        return back()->with('success', 'Dados atualizados!');

    }

    public function updatePart2(Request $request, Opportunity $opportunity)
    {

        $request->validate([
            'benefits' => 'required|string|max:255',
            'skills' => 'required|string|max:255',
            'requisites' => 'required|string|max:255',
            'responsabilities' => 'required|string|max:255',
            'remote' => 'required|boolean',
        ]);

        $update = $request->all();

        $opportunity->update([
            'benefits' => $update["benefits"],
            'competences' => $update["skills"],
            'requirements' => $update["requisites"],
            'responsabilities' => $update["responsabilities"],
            'is_remote' => $update["remote"],
        ]);

        return back()->with('success', 'Dados atualizados!');
    }

    public function updateAddress(Request $request, Opportunity $opportunity)
    {

        $request->validate([
            'cep' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'neighbor' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'number' => 'required|string|max:255',
        ]);

        $update = $request->all();

        $opportunity->address()->update([
            'cep' => $update["cep"],
            'street' => $update["street"],
            'neighborhood' => $update["neighbor"],
            'state' => $update["state"],
            'city' => $update["city"],
            'number' => $update["number"],
        ]);

        return back()->with('success', 'Dados atualizados!');
    }

    public function updateOpportunityStatus(Request $request, Opportunity $opportunity)
    {

        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $update = $request->all();

        $opportunity->update([
            'status' => $update["status"],
        ]);

        return back()->with('success', 'Dados atualizados!');
    }

}
