<?php

namespace App\Http\Controllers;

use App\Models\CurriculumProExperience;
use Illuminate\Http\Request;

class CurriculumProExperienceController extends Controller
{

    public function create(Request $request)
    {
        
        $user = $request->user();

        $user->curriculumProExperiences()->create([
            'company_name' => $request->companyName,
            'role' => $request->role,
            'start_date' => $request->dateStart,
            'end_date' => $request->stillWorking ? null : $request->dateEnd,
            'description' => $request->resume,
            'is_current' => $request->stillWorking ?? false
        ]);

        //verify if the user curriculum is complete
        $request->user()->verifyCurriculumIsComplete();


        return redirect()->route('profile.curriculum.show');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CurriculumProExperience $curriculumProExperience)
    {
        
        $curriculumProExperience->update([
            'company_name' => $request->companyName,
            'role' => $request->role,
            'start_date' => $request->dateStart,
            'end_date' => $request->stillWorking ? null : $request->dateEnd,
            'description' => $request->resume,
            'is_current' => $request->stillWorking ?? false
        ]);

        //verify if the user curriculum is complete
        $request->user()->verifyCurriculumIsComplete();


        return redirect()->route('profile.curriculum.show');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CurriculumProExperience $curriculumProExperience, Request $request)
    {
            
        $curriculumProExperience->delete();

        //verify if the user curriculum is complete
        $request->user()->verifyCurriculumIsComplete();


        return back()->with('success', 'Experiência profissional removida com sucesso');
    }
}
