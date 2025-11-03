<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', [HomeController::class, 'show'])->middleware(['auth', 'verified'])->name('home');

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/post.php';
require __DIR__ . '/company.php';
require __DIR__ . '/company-post.php';
