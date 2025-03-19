<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/profession/{name}', [PageController::class, 'profession'])->name('profession');
Route::get('/question/{id}', [PageController::class, 'question'])->name('question');

Route::get('/mock', [PageController::class, 'mock'])->name('mock');
Route::get('/requirements', [PageController::class, 'requirements'])->name('requirements');
Route::get('/requirements/{name}', [PageController::class, 'requirements_show'])->name('requirements_show');