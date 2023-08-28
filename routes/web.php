<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CurriculumAcadExperienceController;
use App\Http\Controllers\CurriculumCourseController;
use App\Http\Controllers\CurriculumLanguageController;
use App\Http\Controllers\CurriculumProExperienceController;
use App\Http\Controllers\CurriculumResumeController;
use App\Http\Controllers\UserController;
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
    return Inertia::render('FrontPage' );
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

        Route::get('/dashboard', [UserController::class, 'index'])
            ->name('user.dashboard');

        Route::get('/profile/curriculum', [UserController::class, 'curriculum'])
            ->name('profile.curriculum.show');

        Route::post('/profile/curriculum/resume', [CurriculumResumeController::class, 'resumeUpdate'])
            ->name('profile.curriculum.resume.update');

        Route::post('/profile/curriculum/proExperience', [CurriculumProExperienceController::class, 'create'])
            ->name('profile.curriculum.proExperience.create');

        Route::put('/profile/curriculum/proExperience/{curriculumProExperience}', [CurriculumProExperienceController::class, 'update'])
            ->name('profile.curriculum.proExperience.update');

        Route::delete('/profile/curriculum/proExperience/{curriculumProExperience}', [CurriculumProExperienceController::class, 'destroy'])
            ->name('profile.curriculum.proExperience.destroy');

        Route::post('/profile/curriculum/acadExperience', [CurriculumAcadExperienceController::class, 'create'])
            ->name('profile.curriculum.acadExperience.create');

        Route::put('/profile/curriculum/acadExperience/{curriculumAcadExperience}', [CurriculumAcadExperienceController::class, 'update'])
            ->name('profile.curriculum.acadExperience.update');

        Route::delete('/profile/curriculum/acadExperience/{curriculumAcadExperience}', [CurriculumAcadExperienceController::class, 'destroy'])
            ->name('profile.curriculum.acadExperience.destroy');
        
        Route::post('/profile/curriculum/language', [CurriculumLanguageController::class, 'create'])
            ->name('profile.curriculum.language.create');

        Route::put('/profile/curriculum/language/{curriculumLanguage}', [CurriculumLanguageController::class, 'update'])
            ->name('profile.curriculum.language.update');

        Route::delete('/profile/curriculum/language/{curriculumLanguage}', [CurriculumLanguageController::class, 'destroy'])
            ->name('profile.curriculum.language.destroy');

        Route::post('/profile/curriculum/course', [CurriculumCourseController::class, 'create'])
            ->name('profile.curriculum.course.create');

        Route::put('/profile/curriculum/course/{curriculumCourse}', [CurriculumCourseController::class, 'update'])
            ->name('profile.curriculum.course.update');
            
        Route::delete('/profile/curriculum/course/{curriculumCourse}', [CurriculumCourseController::class, 'destroy'])
            ->name('profile.curriculum.course.destroy');

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

Route::get('/opportunities', function () {
    return Inertia::render('Opportunity/List');
})->name('opportunity.list');

Route::get('/opportunity/{id}', function () {
    return Inertia::render('Opportunity/Show');
})->name('opportunity.show');

Route::get('/candidate/profile', function () {
    return Inertia::render('Company/CandidateProfileView');
})->name('candidate.profile.view');
