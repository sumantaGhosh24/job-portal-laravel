<?php

use App\Livewire\Profile\Details;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}', Details::class)->lazy()->name('profile');
});
