<?php

namespace App\Http\Controllers;

use App\Models\CurriculumResume;
use Illuminate\Http\Request;

class CurriculumResumeController extends Controller
{
    public function resumeUpdate(Request $request){
        $user = $request->user();
        $resume = CurriculumResume::where('user_id', $user->id)->first();

        if(!$resume){
            $resume = new CurriculumResume();
            $resume->user_id = $user->id;
        }

        $resume->fill($request->all());
        $resume->save();

        //verify if the user curriculum is complete
        $request->user()->verifyCurriculumIsComplete();


        return redirect()->route('profile.curriculum.show');
    }
}
