<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\StoreController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function(){
    Route::get('stores', [StoreController::class, 'index']);
    Route::get('stocks', [StockController::class, 'index']);
    Route::post('stocks/bulk', [StockController::class, 'bulkStore']);
    Route::delete('stocks/{id}', [StockController::class, 'destroy']);
    Route::post('logout', [AuthController::class, 'logout']);
});