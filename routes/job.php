<?php

use App\Livewire\Applications\Index as ApplicationsIndex;
use App\Livewire\Applications\Manage;
use App\Livewire\Applications\Show as ApplicationsShow;
use App\Livewire\Jobs\Create;
use App\Livewire\Jobs\Edit;
use App\Livewire\Jobs\Index;
use App\Livewire\Jobs\Show;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('jobs')->name('jobs.')->group(function () {
    Route::get('/', Index::class)->lazy()->name('index');

    Route::get('/create/{id}', Create::class)->lazy()->name('create');

    Route::get('/show/{id}', Show::class)->lazy()->name('show');

    Route::get('/{id}', Edit::class)->lazy()->name('edit');
});

Route::middleware('auth')->prefix('applications')->name('applications.')->group(function () {
    Route::get('/', ApplicationsIndex::class)->lazy()->name('index');

    Route::get('/manage', Manage::class)->lazy()->name('manage');

    Route::get('/show/{id}', ApplicationsShow::class)->lazy()->name('show');
});
