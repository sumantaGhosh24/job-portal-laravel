<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function() {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
