<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\Admin\AdminController;
use App\Models\User;

Route::get('/', fn() => Inertia::render('Welcome'))->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => Inertia::render('Dashboard'))->name('dashboard');
    Route::get('/import', fn() => Inertia::render('Import'))->name('import');
    Route::post('/import', [ExcelController::class, 'import'])->name('import');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

Route::get('/users', fn() => response()->json(User::latest()->get()));

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
