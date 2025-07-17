<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

require __DIR__ . '/user.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/employer.php';