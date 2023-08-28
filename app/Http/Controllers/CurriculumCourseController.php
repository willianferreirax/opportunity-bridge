<?php

namespace App\Http\Controllers;

use App\Models\CurriculumCourse;
use Illuminate\Http\Request;

class CurriculumCourseController extends Controller
{

    public function create(Request $request)
    {
        $user = $request->user();

        $user->curriculumCourses()->create([
            'course_name' => $request->courseName,
            'institution_name' => $request->institutionName,
            'start_date' => $request->dateStart,
            'end_date' => $request->dateEnd,
            'still_coursing' => $request->stillCoursing,
        ]);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CurriculumCourse $curriculumCourse)
    {
        $curriculumCourse->update([
            'course_name' => $request->courseName,
            'institution_name' => $request->institutionName,
            'start_date' => $request->dateStart,
            'end_date' => $request->dateEnd,
            'still_coursing' => $request->stillCoursing,
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CurriculumCourse $curriculumCourse)
    {
        //
    }
}
