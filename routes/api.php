<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FoodMenuApiController;

// Public routes
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);

// Protected routes
Route::middleware(['jwt.auth'])->group(function(){
    Route::get('/food-menus', [FoodMenuApiController::class,'index']);
    Route::get('/food-menus/{id}', [FoodMenuApiController::class,'show']);
    Route::post('/food-menus', [FoodMenuApiController::class,'store']);
    Route::put('/food-menus/{id}', [FoodMenuApiController::class,'update']);
    Route::delete('/food-menus/{id}', [FoodMenuApiController::class,'destroy']);
});
