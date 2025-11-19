<?php

use App\Livewire\Posts\Create;
use App\Livewire\Posts\Edit;
use App\Livewire\Posts\Show;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('posts')->name('posts.')->group(function () {
    Route::get('/{id}', Show::class)->lazy()->name('show');

    Route::get('/', Create::class)->lazy()->name('create');

    Route::get('/{id}/edit', Edit::class)->lazy()->name('edit');
});
