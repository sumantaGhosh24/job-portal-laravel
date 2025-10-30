<?php

use App\Http\Controllers\Post\CommentController;
use App\Http\Controllers\Post\LikeController;
use App\Http\Controllers\Post\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('posts')->name('posts.')->group(function () {
    Route::get('/{id}', [PostController::class, 'show'])->name('show');

    Route::get('/', [PostController::class, 'create'])->name('create');

    Route::post('/', [PostController::class, 'store'])->name('store');

    Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');

    Route::patch('/{id}', [PostController::class, 'update'])->name('update');

    Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');

    Route::post('/{post}/like', [LikeController::class, 'toggle'])->name('like');
});

Route::middleware('auth')->group(function () {
    Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('comments.store');
    
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});