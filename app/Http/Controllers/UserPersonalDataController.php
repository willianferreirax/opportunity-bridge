<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserPersonalDataRequest;
use App\Http\Requests\UpdateUserPersonalDataRequest;
use App\Models\UserPersonalData;

class UserPersonalDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserPersonalDataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserPersonalData $userPersonalData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserPersonalData $userPersonalData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserPersonalDataRequest $request, UserPersonalData $userPersonalData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserPersonalData $userPersonalData)
    {
        //
    }
}
