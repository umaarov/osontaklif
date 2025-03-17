<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/profession/{name}', [PageController::class, 'profession'])->name('profession');

Route::get('/mock', [PageController::class, 'mock'])->name('mock');
Route::get('/requirements', [PageController::class, 'requirements'])->name('requirements');
