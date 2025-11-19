<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', Register::class)->lazy()->name('register');

    Route::get('login', Login::class)->lazy()->name('login');
});
