<?php

use App\Http\Controllers\Company\CompanyPostCommentController;
use App\Http\Controllers\Company\CompanyPostController;
use App\Http\Controllers\Company\CompanyPostLikeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('company/posts')->name('company.posts.')->group(function () {
    Route::get('/view/{id}', [CompanyPostController::class, 'show'])->name('show');

    Route::get('/{id}', [CompanyPostController::class, 'create'])->name('create');

    Route::post('/{id}', [CompanyPostController::class, 'store'])->name('store');

    Route::get('/{id}/edit', [CompanyPostController::class, 'edit'])->name('edit');

    Route::patch('/{id}', [CompanyPostController::class, 'update'])->name('update');

    Route::delete('/{id}', [CompanyPostController::class, 'destroy'])->name('destroy');

    Route::post('/{post}/like', [CompanyPostLikeController::class, 'toggle'])->name('like');
});

Route::middleware('auth')->prefix('company')->name('company.')->group(function () {
    Route::post('/posts/{post}/comment', [CompanyPostCommentController::class, 'store'])->name('comments.store');
    
    Route::delete('/comments/{comment}', [CompanyPostCommentController::class, 'destroy'])->name('comments.destroy');
});