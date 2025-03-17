<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/mock', [PageController::class, 'mock'])->name('mock');
Route::get('/requirements', [PageController::class, 'requirements'])->name('requirements');
