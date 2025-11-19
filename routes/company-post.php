<?php

use App\Livewire\CompanyPosts\Create;
use App\Livewire\CompanyPosts\Edit;
use App\Livewire\CompanyPosts\Show;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('company/posts')->name('company.posts.')->group(function () {
    Route::get('/view/{id}', Show::class)->lazy()->name('show');

    Route::get('/{id}', Create::class)->lazy()->name('create');

    Route::get('/{id}/edit', Edit::class)->lazy()->name('edit');
});
