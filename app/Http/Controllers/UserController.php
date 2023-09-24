<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\OpportunityUser;
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
            ->whereDoesntHave('appliedUsers', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->where('status', 'Aberta')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        //fetch two last opportunities applied by the user
        $lastApplied = OpportunityUser::with('opportunity.address')
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

        return Inertia::render('Profile/Curriculum/Show', [
            'resume' => $resume,
            'professionalExperiences' => $proExp,
            'academicExperiences' => $acadExp,
            'courses' => $courses,
            'languages' => $languages,
        ]);
    }

    public function recommendedJobs()
    {

        $opportunities = \App\Models\Opportunity::with('address')
            ->with('appliedUsers')
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
        $user->load('address');
        $user->load('contact');

        return Inertia::render('Company/CandidateProfileView', [
            'user' => $user,
        ]);
    }
}
