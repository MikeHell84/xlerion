<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

// Logout: supports session and token revocation (Sanctum)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/password/forgot', [AuthController::class, 'forgotPassword']);
Route::post('/password/reset', [AuthController::class, 'resetPassword']);

// Return authenticated user (supports Sanctum token auth)
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');

// Example protected route for sellers/admins (token-based)
Route::middleware(['auth:sanctum','role:seller,admin'])->group(function () {
    Route::get('/seller/dashboard', function (Request $request) {
        return response()->json(['ok' => true]);
    });
});
