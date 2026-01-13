<?php

use App\Http\Controllers\FoodMenuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); // Breeze welcome.blade.php
});

/* Dashboard */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* Protected WEB routes (session-based) */
Route::middleware(['auth', 'verified'])->group(function () {

    // Food Menu CRUD (Blade UI)
    Route::resource('food-menus', FoodMenuController::class);

    // Optional: client-side DataTable data endpoint
    Route::get('/food-menus-data', [FoodMenuController::class, 'getData'])
        ->name('food-menus.data');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
