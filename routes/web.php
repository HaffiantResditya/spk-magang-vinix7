<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HrdController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;

// Public Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Role-based Dashboard Dispatcher
Route::get('/dashboard', function () {
    return AuthController::redirectByRole();
})->middleware(['auth'])->name('dashboard');

// Applicant Portal Routes
Route::middleware(['auth', 'role:applicant'])->prefix('applicant')->name('applicant.')->group(function () {
    Route::get('/dashboard', [ApplicantController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ApplicantController::class, 'profile'])->name('profile');
    Route::put('/profile', [ApplicantController::class, 'updateProfile'])->name('profile.update');
    Route::get('/assessment', [ApplicantController::class, 'assessment'])->name('assessment');
    Route::get('/results', [ApplicantController::class, 'results'])->name('results');
    Route::post('/apply', [ApplicantController::class, 'submitApplication'])->name('apply');
});

// HRD Admin Routes
Route::middleware(['auth', 'role:hrd,superadmin'])->prefix('hrd')->name('hrd.')->group(function () {
    Route::get('/dashboard', [HrdController::class, 'dashboard'])->name('dashboard');
    Route::get('/applicants', [HrdController::class, 'applicants'])->name('applicants');
    Route::get('/applicants/{applicant}', [HrdController::class, 'applicantDetail'])->name('applicants.detail');
    Route::put('/applications/{application}/status', [HrdController::class, 'updateStatus'])->name('applicants.updateStatus');
});

// Super Admin Routes
Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');
    
    // Master Divisions
    Route::get('/divisions', [SuperAdminController::class, 'divisions'])->name('divisions');
    Route::post('/divisions', [SuperAdminController::class, 'storeDivision'])->name('divisions.store');
    Route::put('/divisions/{division}', [SuperAdminController::class, 'updateDivision'])->name('divisions.update');
    Route::delete('/divisions/{division}', [SuperAdminController::class, 'destroyDivision'])->name('divisions.destroy');

    // Master Criteria & Questions
    Route::get('/criteria', [SuperAdminController::class, 'criteria'])->name('criteria');
    Route::put('/criteria/{criterion}', [SuperAdminController::class, 'updateCriterion'])->name('criteria.update');
    Route::post('/questions', [SuperAdminController::class, 'storeQuestion'])->name('questions.store');
    Route::put('/questions/{question}', [SuperAdminController::class, 'updateQuestion'])->name('questions.update');
    Route::delete('/questions/{question}', [SuperAdminController::class, 'destroyQuestion'])->name('questions.destroy');

    // Dynamic Matrix Weights
    Route::get('/matrix-weights', [SuperAdminController::class, 'matrixWeights'])->name('matrix-weights');
    Route::put('/matrix-weights', [SuperAdminController::class, 'updateMatrixWeights'])->name('matrix-weights.update');
});

// User Profile & Account Settings
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
