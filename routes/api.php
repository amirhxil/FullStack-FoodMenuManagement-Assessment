<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FoodMenuApiController;

/*
|--------------------------------------------------------------------------
| Public Auth Routes (JWT)
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Protected Routes (JWT REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware(['jwt.auth'])->group(function () {

    // Auth
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Food Menu CRUD (RESTful)
    Route::get('/food-menus', [FoodMenuApiController::class, 'index']);
    Route::get('/food-menus/{id}', [FoodMenuApiController::class, 'show']);
    Route::post('/food-menus', [FoodMenuApiController::class, 'store']);
    Route::put('/food-menus/{id}', [FoodMenuApiController::class, 'update']);
    Route::delete('/food-menus/{id}', [FoodMenuApiController::class, 'destroy']);

});
