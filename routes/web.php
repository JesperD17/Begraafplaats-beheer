<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Middleware\EnsureAdminRole;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// Pages
Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'index'])
->middleware([EnsureAdminRole::class]);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
