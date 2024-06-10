<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'login'])->name('view.login');
Route::get('/register', [DashboardController::class, 'register'])->name('view.register');

Route::middleware(['check.api.access'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('view.dashboard');
    Route::get('/post', [DashboardController::class, 'post'])->name('view.post');
});
