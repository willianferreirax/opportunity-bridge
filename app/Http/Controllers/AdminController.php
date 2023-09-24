<?php

namespace App\Http\Controllers;

use App\Models\OpportunityUser;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard()
    {
        if(auth()->user()->type != 'admin'){
            return redirect()->route('user.dashboard');
        }

        return Inertia::render('Admin/Dashboard');
    }
}
