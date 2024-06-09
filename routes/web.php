<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'login'])->name('view.login');
Route::get('/register', [DashboardController::class, 'register'])->name('view.register');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('view.dashboard');