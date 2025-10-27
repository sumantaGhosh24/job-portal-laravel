<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/home', [ProfileController::class, 'index'])->middleware(['verified'])->name('home');

    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile');

    Route::patch('/profile/personal', [ProfileController::class, 'personal'])->name('profile.update.personal');

    Route::patch('/profile/profile_image', [ProfileController::class, 'profile_image'])->name('profile.update.profile_image');

    Route::patch('/profile/background_image', [ProfileController::class, 'background_image'])->name('profile.update.background_image');

    Route::patch('/profile/password', [ProfileController::class, 'password'])->name('profile.update.password');

    Route::patch('/profile/professional', [ProfileController::class, 'professional_summary'])->name('profile.update.professional');

    Route::patch('/profile/resume', [ProfileController::class, 'resume'])->name('profile.update.resume');

    Route::patch('/profile/social', [ProfileController::class, 'social'])->name('profile.update.social');

    Route::post('/profile/language', [ProfileController::class, 'add_language'])->name('profile.language.add');

    Route::patch('/profile/language/{id}', [ProfileController::class, 'update_language'])->name('profile.language.update');

    Route::delete('/profile/language/{id}', [ProfileController::class, 'remove_language'])->name('profile.language.remove');

    Route::post('/profile/certificate', [ProfileController::class, 'add_certificate'])->name('profile.certificate.add');

    Route::patch('/profile/certificate/{id}', [ProfileController::class, 'update_certificate'])->name('profile.certificate.update');

    Route::delete('/profile/certificate/{id}', [ProfileController::class, 'remove_certificate'])->name('profile.certificate.remove');

    Route::post('/profile/project', [ProfileController::class, 'add_project'])->name('profile.project.add');

    Route::patch('/profile/project/{id}', [ProfileController::class, 'update_project'])->name('profile.project.update');

    Route::delete('/profile/project/{id}', [ProfileController::class, 'remove_project'])->name('profile.project.remove');

    Route::post('/profile/skill', [ProfileController::class, 'add_skill'])->name('profile.skill.add');

    Route::patch('/profile/skill/{id}', [ProfileController::class, 'update_skill'])->name('profile.skill.update');

    Route::delete('/profile/skill/{id}', [ProfileController::class, 'remove_skill'])->name('profile.skill.remove');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('logout', [ProfileController::class, 'logout'])->name('logout');
});