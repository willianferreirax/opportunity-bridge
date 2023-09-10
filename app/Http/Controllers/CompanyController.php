<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\OpportunityUser;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function dashboard(){
        
        //fetch the last two applications to an opportunity
        $appliedUsers = OpportunityUser::with('user')
            ->with('opportunity')
            ->whereHas('opportunity', function ($query) {
                $query->where('company_id', auth()->user()->company->id);
            })
            ->orderBy('created_at', 'desc')
            ->limit(2); 


        $opportunities = \App\Models\Opportunity::withCount('appliedUsers')
            ->where('company_id', auth()->user()->company->id)
            ->orderBy('created_at', 'desc')
            ->limit(2);

        return Inertia::render('Company/Dashboard', [
            'opportunities' => $opportunities->get(),
            'appliedUsers' => $appliedUsers->get(),
        ]);
    }
}
