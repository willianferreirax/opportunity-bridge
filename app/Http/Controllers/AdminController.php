<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\User;
use Carbon\Carbon;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard()
    {
        if(auth()->user()->type != 'admin'){
            return redirect()->route('user.dashboard');
        }

        $startDate = Carbon::now()->subDays(7); // Get the date 7 days ago
        $endDate = Carbon::now(); // Get the current date

        $newOpportunities = Opportunity::selectRaw('DATE(created_at) as label, COUNT(*) as total')
            ->whereBetween('created_at', [$startDate->format('Y-m-d H:i:s'), $endDate->format('Y-m-d H:i:s')])
            ->groupBy('label')
            ->get()
            ->toArray();

        $newUsers = User::selectRaw('DATE(created_at) as label, COUNT(*) as total, name')
            ->where('type', 'candidate')
            ->whereBetween('created_at', [$startDate->format('Y-m-d H:i:s'), $endDate->format('Y-m-d H:i:s')])
            ->groupBy('label', 'name')
            ->get()
            ->toArray();

        $newCompanies = User::selectRaw('DATE(created_at) as label, COUNT(*) as total')
            ->where('type', 'company')
            ->whereBetween('created_at', [$startDate->format('Y-m-d H:i:s'), $endDate->format('Y-m-d H:i:s')])
            ->groupBy('label')
            ->get()
            ->toArray();

        return Inertia::render('Admin/Dashboard', [
            'newOpportunities' => $newOpportunities,
            'newUsers' => $newUsers,
            'newCompanies' => $newCompanies,
        ]);
    }
}
