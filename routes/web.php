<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('FrontPage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('frontpage');

Route::prefix('auth')->group(function (){
    Route::post('register/user', [AuthController::class, 'registerUser'])
        ->name('register.user');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::prefix('admin')->group(function() {

        Route::get('dashboard', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('admin.dashboard');

    });

    Route::prefix('user')->group(function () {

        Route::get('/dashboard', function () {
            return Inertia::render('User/Dashboard');
        })->name('user.dashboard');

        Route::get('/recommendedJobs', function () {
            return Inertia::render('User/RecommendedOpportunities');
        })->name('user.recommendedJobs');

        Route::get('/appliedJobs', function () {
            return Inertia::render('User/AppliedOpportunities');
        })->name('user.appliedJobs');

    });

    Route::prefix('company')->group(function() {

        Route::get('register', function () {
            return Inertia::render('Auth/CompanyRegister');
        })->name('company.register');

        Route::get('dashboard', function () {
            return Inertia::render('Company/Dashboard');
        })->name('company.dashboard');

        Route::get('announced', function () {
            return Inertia::render('Company/ListAnnouncedJobs');
        })->name('company.announced');

        Route::get('candidates', function () {
            return Inertia::render('Company/CandidateList');
        })->name('company.candidates');

        Route::get('opportunity/{id}', function () {
            return Inertia::render('Company/OpportunityReport');
        })->name('company.opportunitiy.report');

    });

});

Route::get('/opportunity/create', function () {
    return Inertia::render('Opportunity/Create');
})->name('opportunity.create');

Route::get('/opportunity/edit', function () {
    return Inertia::render('Opportunity/Edit');
})->name('opportunity.edit');

Route::get('/profile/curriculum', function () {
    return Inertia::render('Profile/Curriculum/Show');
})->name('profile.curriculum.show');

Route::get('/opportunities', function () {
    return Inertia::render('Opportunity/List');
})->name('opportunity.list');

Route::get('/opportunity/{id}', function () {
    return Inertia::render('Opportunity/Show');
})->name('opportunity.show');

Route::get('/candidate/profile', function () {
    return Inertia::render('Company/CandidateProfileView');
})->name('candidate.profile.view');
