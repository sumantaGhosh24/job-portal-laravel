<?php

use App\Livewire\Companies\Create;
use App\Livewire\Companies\Details;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('companies')->name('companies.')->group(function () {
    Route::get('/create', Create::class)->lazy()->name('create');

    Route::get('/{id}', Details::class)->lazy()->name('show');
});
