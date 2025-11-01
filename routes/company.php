<?php

use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\MemberController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('companies')->name('companies.')->group(function () {
    Route::get('/create', [CompanyController::class, 'create'])->name('create');

    Route::post('/', [CompanyController::class, 'store'])->name('store');

    Route::get('/{id}', [CompanyController::class, 'show'])->name('show');

    Route::patch('/information/{id}', [CompanyController::class, 'information'])->name('information');

    Route::patch('/description/{id}', [CompanyController::class, 'description'])->name('description');

    Route::patch('/logo/{id}', [CompanyController::class, 'logo'])->name('logo');

    Route::patch('/banner/{id}', [CompanyController::class, 'banner'])->name('banner');

    Route::patch('/social/{id}', [CompanyController::class, 'social'])->name('social');
});

Route::middleware('auth')->name('members.')->group(function () {
    Route::post('/companies/{id}/members', [MemberController::class, 'store'])->name('store');

    Route::patch('/companies/{id}/members/{memberId}', [MemberController::class, 'update'])->name('update');

    Route::delete('/members/{id}/remove', [MemberController::class, 'remove'])->name('remove');
});