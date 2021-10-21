<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/', fn() => redirect('dashboard'))->name('home');
    Route::get('/dashboard', fn() => Inertia::render('Dashboard'))->name('dashboard');
    Route::apiResource('contacts', ContactController::class)->except(['show']);
    Route::apiResource('users', UserController::class)->except(['show']);
});
