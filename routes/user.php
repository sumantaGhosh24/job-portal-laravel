<?php
use App\Http\Controllers\Profile\CertificateController;
use App\Http\Controllers\Profile\EducationController;
use App\Http\Controllers\Profile\FollowController;
use App\Http\Controllers\Profile\LanguageController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\ProjectController;
use App\Http\Controllers\Profile\SkillController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile');

    Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');

    Route::post('/users/{user}/follow', [FollowController::class, 'follow'])->name('users.follow');

    Route::delete('/users/{user}/unfollow', [FollowController::class, 'unfollow'])->name('users.unfollow');
});

Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::name('update.')->group(function () {
        Route::patch('/personal', [ProfileController::class, 'personal'])->name('personal');
    
        Route::patch('/profile_image', [ProfileController::class, 'profile_image'])->name('profile_image');
    
        Route::patch('/background_image', [ProfileController::class, 'background_image'])->name('background_image');
    
        Route::patch('/password', [ProfileController::class, 'password'])->name('password');
    
        Route::patch('/professional', [ProfileController::class, 'professional_summary'])->name('professional');
    
        Route::patch('/resume', [ProfileController::class, 'resume'])->name('resume');
    
        Route::patch('/social', [ProfileController::class, 'social'])->name('social');
    });

    Route::prefix('language')->name('language.')->group(function () {
        Route::post('/', [LanguageController::class, 'add'])->name('add');
    
        Route::patch('/{id}', [LanguageController::class, 'update'])->name('update');
    
        Route::delete('/{id}', [LanguageController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('certificate')->name('certificate.')->group(function () {
        Route::post('/', [CertificateController::class, 'add'])->name('add');
    
        Route::patch('/{id}', [CertificateController::class, 'update'])->name('update');
    
        Route::delete('/{id}', [CertificateController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('project')->name('project.')->group(function () {
        Route::post('/', [ProjectController::class, 'add'])->name('add');
    
        Route::patch('/{id}', [ProjectController::class, 'update'])->name('update');
    
        Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('skill')->name('skill.')->group(function () {
        Route::post('/', [SkillController::class, 'add'])->name('add');
    
        Route::patch('/{id}', [SkillController::class, 'update'])->name('update');
    
        Route::delete('/{id}', [SkillController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('education')->name('education.')->group(function () {
        Route::post('/', [EducationController::class, 'add'])->name('add');
    
        Route::patch('/{id}', [EducationController::class, 'update'])->name('update');
    
        Route::delete('/{id}', [EducationController::class, 'destroy'])->name('destroy');
    });

    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});