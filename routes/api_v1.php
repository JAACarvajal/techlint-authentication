<?php

use App\Http\Controllers\V1\UserController;
use Illuminate\Support\Facades\Route;

// User route
Route::apiResource('users', UserController::class);
