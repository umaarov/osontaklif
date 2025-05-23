<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/professions/{profession}', [PageController::class, 'profession'])->name('profession');

Route::get('/questions/{question}/{professionSlug?}', [PageController::class, 'question'])->name('question.show');

Route::get('/mock-interviews', [PageController::class, 'mock'])->name('mock');

Route::get('/requirements', [PageController::class, 'requirements'])->name('requirements');

Route::get('/requirements/{profession}', [PageController::class, 'requirement_show'])->name('requirements.show');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/sponsorship', [PageController::class, 'sponsorship'])->name('sponsorship');
Route::get('/ads', [PageController::class, 'ads'])->name('ads');
