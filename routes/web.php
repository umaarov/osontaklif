<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/profession/{name}', [PageController::class, 'profession'])->name('profession');
Route::get('/question/{id}', [PageController::class, 'question'])->name('question');

Route::get('/mock', [PageController::class, 'mock'])->name('mock');
Route::get('/requirements', [ProfessionController::class, 'index'])->name('requirements');
Route::get('/requirements/{name}', [ProfessionController::class, 'show'])->name('profession.show');
