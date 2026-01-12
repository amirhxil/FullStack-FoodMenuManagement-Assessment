<?php
use App\Http\Controllers\FoodMenuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/* AUTH ROUTES (Breeze) */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    // Food Menu CRUD
    Route::get('/food-menus', [FoodMenuController::class, 'index'])->name('food_menus.index');
    Route::get('/food-menus/create', [FoodMenuController::class, 'create'])->name('food_menus.create');
    Route::post('/food-menus', [FoodMenuController::class, 'store'])->name('food_menus.store');
    Route::get('/food-menus/{id}/edit', [FoodMenuController::class, 'edit'])->name('food_menus.edit');
    Route::put('/food-menus/{id}', [FoodMenuController::class, 'update'])->name('food_menus.update');
    Route::delete('/food-menus/{id}', [FoodMenuController::class, 'destroy'])->name('food_menus.destroy');

    // DataTables
    Route::get('/food-menus-data', [FoodMenuController::class, 'getData'])->name('food_menus.data');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

