<?php

namespace App\Http\Controllers;

use App\Models\CurriculumLanguage;
use Illuminate\Http\Request;

class CurriculumLanguageController extends Controller
{

    public function create(Request $request)
    {
        
        $user = $request->user();

        $user->curriculumLanguages()->create([
            'institution_name' => $request->institutionName,
            'language' => $request->language,
            'level' => $request->level,
        ]);

        //verify if the user curriculum is complete
        $user->verifyCurriculumIsComplete();

        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CurriculumLanguage $curriculumLanguage)
    {

        $curriculumLanguage->update([
            'institution_name' => $request->institutionName,
            'language' => $request->language,
            'level' => $request->level,
        ]);

        //verify if the user curriculum is complete
        $request->user()->verifyCurriculumIsComplete();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CurriculumLanguage $curriculumLanguage, Request $request)
    {
        $curriculumLanguage->delete();

        //verify if the user curriculum is complete
        $request->user()->verifyCurriculumIsComplete();

        return back()->with('success', 'Idioma removido com sucesso');
    }
}
