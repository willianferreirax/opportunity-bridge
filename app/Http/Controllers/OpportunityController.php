<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
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


        return Inertia::render('Company/OpportunityReport',
            [
                'opportunity' => $opportunity,
            ]
        );
    }

    public function opportunityShow(Opportunity $opportunity)
    {

        $opportunity
            ->load('address')
            ->load('company');

        $hasApplied = $opportunity->appliedUsers()
            ->where('user_id', auth()->user()->id)
            ->exists();

        return Inertia::render('Opportunity/Show',[
            'opportunity' => $opportunity,
            'hasApplied' => $hasApplied,
        ]);

    }

    public function appliedUsers(Opportunity $opportunity)
    {

        $opportunity->load('appliedUsers')
            ->load('appliedUsers.address');

        return Inertia::render('Company/CandidateList',
            [
                'opportunity' => $opportunity,
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
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        //preserve search query
        $opportunities->appends(['search' => $search]);

        return Inertia::render('Opportunity/List',[
            'opportunities' => $opportunities,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     */
    public function show(Opportunity $opportunity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Opportunity $opportunity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Opportunity $opportunity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opportunity $opportunity)
    {
        //
    }
}
