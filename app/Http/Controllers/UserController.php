<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\OpportunityUser;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {

        //fetch two last created opportunities that the user has not applied yet by any company
        
        $opportunities = \App\Models\Opportunity::with('address')
            ->with('appliedUsers')
            ->whereDoesntHave('appliedUsers', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        //fetch two last opportunities applied by the user
        $lastApplied = OpportunityUser::with('opportunity.address')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

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
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('User/RecommendedOpportunities',[
            'opportunities' => $opportunities,

        ]);
    }

    public function apply(Opportunity $opportunity)
    {
        $opportunity->appliedUsers()->attach(auth()->user()->id);

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
}
