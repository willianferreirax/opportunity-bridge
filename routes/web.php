<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CurriculumAcadExperienceController;
use App\Http\Controllers\CurriculumCourseController;
use App\Http\Controllers\CurriculumLanguageController;
use App\Http\Controllers\CurriculumProExperienceController;
use App\Http\Controllers\CurriculumResumeController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\UserController;
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

Route::get('/register', function () {
    return Inertia::render('Auth/Register', [
        'deficiences' => \App\Models\Deficiency::all()
    ]);
})->name('register');

Route::prefix('auth')->group(function (){
    Route::post('register/user', [AuthController::class, 'registerUser'])
        ->name('register.user');

    Route::post('register/company', [AuthController::class, 'registerCompany'])
        ->name('auth.register.company');
});

Route::get('company/register', function () {
    return Inertia::render('Auth/CompanyRegister');
})->name('company.register');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::prefix('admin')->group(function() {

        Route::get('dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');

        Route::post('/upload/certificate', [CertificateController::class, 'store'])
            ->name('admin.upload.certificate');

    });

    Route::prefix('user')->group(function () {

        Route::post('/apply/{opportunity}', [UserController::class, 'apply'])
            ->name('user.apply');

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

        Route::get('/recommendedJobs', [UserController::class, 'recommendedJobs'])
            ->name('user.recommendedJobs');

        Route::get('/appliedJobs', [UserController::class, 'appliedJobs'])
            ->name('user.appliedJobs');

    });

    Route::prefix('company')->group(function() {

        Route::get('dashboard', [CompanyController::class, 'dashboard'])->name('company.dashboard');

        Route::get('announced', [OpportunityController::class, 'listAnnouncedJobs'])
            ->name('company.announced');

        Route::get('candidates/{opportunity}', [OpportunityController::class, 'appliedUsers'])
            ->name('company.candidates');

        Route::get('opportunity/{opportunity}', [OpportunityController::class, 'opportunityReport'])
            ->name('company.opportunitiy.report');

    });

    Route::get('/opportunity/create', function () {

        $deficiences = \App\Models\Deficiency::all();
    
        return Inertia::render('Opportunity/Create', [
            'deficiences' => $deficiences
        ]);
    
    })->name('opportunity.create');
    
    Route::post('/opportunity/create', [OpportunityController::class, 'store'])
        ->name('opportunity.store');
    
    Route::get('/opportunity/edit/{opportunity}', [OpportunityController::class, 'edit'])->name('opportunity.edit');
    
    Route::get('/opportunities', [OpportunityController::class, 'showAllOpportunities'])
        ->name('opportunity.list');
    
    Route::get('/opportunity/{opportunity}', [OpportunityController::class, 'opportunityShow'])
        ->name('opportunity.show');
    
    Route::get('/candidate/profile/{user}', [UserController::class, "publicProfile"])
        ->name('candidate.profile.view');

    Route::post('/candidate/nextStep', [OpportunityController::class, "nextStep"])
        ->name('candidate.nextStep');

    Route::post('/candidate/backStep', [OpportunityController::class, "backStep"])
        ->name('candidate.backStep');

    Route::post('/candidate/interviewDate', [OpportunityController::class, "setInterviewDate"])
        ->name('candidate.setInterviewDate');
    
    Route::post('/candidate/videoInterview', [OpportunityController::class, "setVideoInterview"])
        ->name('candidate.setVideoInterview');

    Route::get('/candidate/downloadVideoInterview/{video}', [OpportunityController::class, "downloadVideoInterview"])
        ->name('candidate.downloadVideoInterview');

    Route::put('/candidate/status', [OpportunityController::class, "updateCandidateStatus"])
        ->name('candidate.status.update');
    
    Route::put("/opportunity/update/stepOne/{opportunity}", [OpportunityController::class, 'updatePart1'])
        ->name('opportunity.update.step1');

    Route::put("/opportunity/update/stepTwo/{opportunity}", [OpportunityController::class, 'updatePart2'])
        ->name('opportunity.update.step2');

    Route::put("/opportunity/update/stepThree/{opportunity}", [OpportunityController::class, 'updateAddress'])
        ->name('opportunity.update.step3');

    Route::put("/opportunity/update/status/{opportunity}", [OpportunityController::class, 'updateOpportunityStatus'])
        ->name('opportunity.update.status');

});


