<?php

namespace App\Http\Controllers;

use App\Models\CreativeCurriculum;
use Illuminate\Http\Request;

class CreativeCurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'file' => 'required|mimes:doc,docx,pdf,mp4',
        ]);

        $file = $request->file('file');

        // Get the original file extension
        $extension = $file->getClientOriginalExtension();

        $filename = uniqid(). "." . $extension;

        //verify storage exist and create if not with permissions


        $path = $request->file->storeAs("public/creativeCurriculum", $filename);

        $user->creativeCurriculums()->create([
            'file_name' => $file->getClientOriginalName(),
            'path' => $path,
        ]);

        return back()->with('success', 'Arquivo enviado com sucesso');

    }

    public function downloadFile(CreativeCurriculum $creativeCurriculum)
    {
        return response()->download(storage_path("app/" . $creativeCurriculum->path));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CreativeCurriculum $creativeCurriculum)
    {
        $creativeCurriculum->delete();

        return back()->with('success', 'Arquivo removido com sucesso');
    }
}
