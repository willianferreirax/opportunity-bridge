<?php

namespace App\Http\Controllers;

use App\Models\CurriculumAcadExperience;
use Illuminate\Http\Request;

class CurriculumAcadExperienceController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = $request->user();

        $user->curriculumAcadExperiences()->create([
            'institution_name' => $request->institutionName,
            'course_name' => $request->courseName,
            'start_date' => $request->dateStart,
            'end_date' => $request->stillStudying ? null : $request->dateEnd,
            'still_coursing' => $request->stillStudying ?? false
        ]);

        //verify if the user curriculum is complete
        $request->user()->verifyCurriculumIsComplete();

        return redirect()->route('profile.curriculum.show');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CurriculumAcadExperience $curriculumAcadExperience)
    {
        $curriculumAcadExperience->update([
            'institution_name' => $request->institutionName,
            'course_name' => $request->courseName,
            'start_date' => $request->dateStart,
            'end_date' => $request->stillStudying ? null : $request->dateEnd,
            'still_coursing' => $request->stillStudying ?? false
        ]);

        //verify if the user curriculum is complete
        $request->user()->verifyCurriculumIsComplete();


        return redirect()->route('profile.curriculum.show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CurriculumAcadExperience $curriculumAcadExperience, Request $request)
    {
        $curriculumAcadExperience->delete();

        //verify if the user curriculum is complete
        $request->user()->verifyCurriculumIsComplete();


        return back()->with('success', 'Experiência acadêmica removida com sucesso');
    }
}
