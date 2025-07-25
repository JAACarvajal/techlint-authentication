<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Health check routes
Route::get('/health-check', function () {
    return response()->json(['message' => 'OK']);
});

// User autentication routes
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('check', [AuthController::class, 'check'])->name('auth.check');
    });
});


