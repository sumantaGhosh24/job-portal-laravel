<?php

use App\Livewire\Home;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class)->lazy()->name('welcome');

Route::get('/home', Home::class)->lazy()->middleware('auth')->name('home');

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/post.php';
require __DIR__ . '/company.php';
require __DIR__ . '/company-post.php';
require __DIR__ . '/job.php';
