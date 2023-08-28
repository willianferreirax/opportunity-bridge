<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('User/Dashboard');
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
}
