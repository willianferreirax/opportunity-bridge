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

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CurriculumLanguage $curriculumLanguage)
    {
        //
    }
}
