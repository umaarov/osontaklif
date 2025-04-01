<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/profession/{name}', [PageController::class, 'profession'])->name('profession');
//Route::get('/question/{id}', [PageController::class, 'question'])->name('question');
Route::get('/question/{id}/{profession?}', [PageController::class, 'question'])->name('question');

Route::get('/mock', [PageController::class, 'mock'])->name('mock');
Route::get('/requirements', [PageController::class, 'requirements'])->name('requirements');
Route::get('/requirements/{name}', [PageController::class, 'requirement_show'])->name('requirements.show');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/sponsorship', [PageController::class, 'sponsorship'])->name('sponsorship');
Route::get('/ads', [PageController::class, 'ads'])->name('ads');
