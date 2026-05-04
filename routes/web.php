<?php

use App\Http\Controllers\PublicDashboardController;
use Illuminate\Support\Facades\Route;

// Root URL → public donation dashboard (no login required)
Route::get('/', [PublicDashboardController::class, 'index'])->name('public.dashboard');

// Explicit /dashboard alias
Route::get('/dashboard', [PublicDashboardController::class, 'index'])->name('public.dashboard.alias');
