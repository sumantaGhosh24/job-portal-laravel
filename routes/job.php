<?php

use App\Http\Controllers\Job\JobApplicationController;
use App\Http\Controllers\Job\JobController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('jobs')->name('jobs.')->group(function () {
    Route::get('/', [JobController::class, 'index'])->name('index');
    
    Route::get('/create/{id}', [JobController::class, 'create'])->name('create');
    
    Route::post('/{id}', [JobController::class, 'store'])->name('store');
    
    Route::get('/show/{id}', [JobController::class, 'show'])->name('show');
    
    Route::get('/{id}', [JobController::class, 'edit'])->name('edit');
    
    Route::patch('/{id}', [JobController::class, 'update'])->name('update');
    
    Route::delete('/{id}', [JobController::class, 'destroy'])->name('destroy');
});

Route::middleware('auth')->prefix('applications')->name('applications.')->group(function () {
    Route::get('/', [JobApplicationController::class, 'index'])->name('index');

    Route::get('/manage', [JobApplicationController::class, 'manage'])->name('manage');

    Route::post('/{id}', [JobApplicationController::class, 'store'])->name('store');

    Route::get('/show/{id}', [JobApplicationController::class, 'show'])->name('show');

    Route::patch('/status/{id}', [JobApplicationController::class, 'updateStatus'])->name('status');
});