<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\Opportunity;
use App\Models\OpportunityUser;
use App\Models\Skin;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {//THIS SHOULD BE DONE IN A REPOSITORY OR SERVICE

        //fetch two last created opportunities that the user has not applied yet by any company
        
        $opportunities = \App\Models\Opportunity::with('address')
            ->with('appliedUsers')
            ->with('company')
            ->whereDoesntHave('appliedUsers', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->where('status', 'Aberta')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        //fetch two last opportunities applied by the user
        $lastApplied = OpportunityUser::with('opportunity.address')
            ->with('opportunity.company')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        //get steps of opportunities
        $lastApplied->each(function ($opportunity, $key) {

            $oportunitySimpleSteps = $opportunity->opportunity
                ->simpleSteps()
                ->count();

            $oportunityVideoSteps = $opportunity->opportunity
                ->videoSteps()
                ->count();

            $oportunityInterviewSteps = $opportunity->opportunity
                ->interviewSteps()
                ->count();

            $oportunityTestSteps = $opportunity->opportunity
                ->testSteps()
                ->count();

            $steps = $oportunitySimpleSteps + $oportunityVideoSteps + $oportunityInterviewSteps + $oportunityTestSteps;

            $opportunity->steps = $steps;
        });

        return Inertia::render('User/Dashboard',[
            'opportunities' => $opportunities,
            'lastApplied' => $lastApplied,
        ]);
    }

    public function curriculum(Request $request){

        $user = $request->user();

        $resume = $user->curriculumResume()->first()?->resume;

        $proExp = $user->curriculumProExperiences()->get();

        $acadExp = $user->curriculumAcadExperiences()->get();

        $courses = $user->curriculumCourses()->get();

        $languages = $user->curriculumLanguages()->get();

        $creative = $user->creativeCurriculums()->get();

        return Inertia::render('Profile/Curriculum/Show', [
            'resume' => $resume,
            'professionalExperiences' => $proExp,
            'academicExperiences' => $acadExp,
            'courses' => $courses,
            'languages' => $languages,
            'creativeCurriculums' => $creative,
        ]);
    }

    public function recommendedJobs()
    {

        $opportunities = \App\Models\Opportunity::with('address')
            ->with('appliedUsers')
            ->with('company')
            ->whereDoesntHave('appliedUsers', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->where('status', 'Aberta')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('User/RecommendedOpportunities',[
            'opportunities' => $opportunities,

        ]);
    }

    public function apply(Opportunity $opportunity)
    {

        //verify opportunity is not closed
        if ($opportunity->status != 'Aberta') {
            return back()->with('error', 'Esta vaga está fechada!');
        }

        $opportunity->appliedUsers()
            ->attach(auth()->user()->id, [
                'current_step' => 0,
                'status' => 'applied',
            ]);

        return back()->with('success', 'Você se candidatou a vaga com sucesso!');

    }

    public function appliedJobs(){
        $opportunities = Opportunity::with('appliedUsers')
            ->with('address')
            ->with('company')
            ->whereHas('appliedUsers', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('User/AppliedOpportunities',[
            'opportunities' => $opportunities,
        ]);
    }

    public function publicProfile(User $user)
    {

        $user->load('curriculumResume');
        $user->load('curriculumProExperiences');
        $user->load('curriculumAcadExperiences');
        $user->load('curriculumCourses');
        $user->load('curriculumLanguages');
        $user->load('creativeCurriculums');
        $user->load('address');
        $user->load('contact');
        $user->load('personal');
        $user->load('deficiences');

        $skin = Skin::where('id', $user->personal->skin_id)->first()?->label;

        $user->personal->skin = $skin ?? 'Prefiro não informar';

        $genero = Gender::where('id', $user->personal->gender_id)->first()?->label;

        $user->personal->gender = $genero ?? 'Prefiro não informar';

        $nascionality = $user->personal->nacionality == 1 ? 'Brasileiro' : 'Estrangeiro';

        $nascionality = $nascionality ?? 'Prefiro não informar';

        $user->personal->nacionality2 = $nascionality;

        return Inertia::render('Company/CandidateProfileView', [
            'user' => $user,
        ]);
    }
}
