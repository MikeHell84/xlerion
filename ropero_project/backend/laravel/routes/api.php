<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

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

// Temporary debug route: returns request headers (including Authorization)
Route::get('/debug-headers', function (Request $request) {
    $headers = [];
    foreach ($request->headers->all() as $key => $values) {
        $headers[$key] = implode(', ', $values);
    }
    return response()->json(['authorization' => $request->header('authorization'), 'headers' => $headers]);
});

// Debug route: verify token via Sanctum's PersonalAccessToken::findToken
Route::get('/debug-verify-token', function (Request $request) {
    $plain = $request->bearerToken();
    $pat = null;
    try {
        $pat = PersonalAccessToken::findToken($plain);
    } catch (\Throwable $e) {
        return response()->json(['error' => 'exception', 'message' => $e->getMessage(), 'bearer' => $plain]);
    }

    return response()->json([
        'bearer' => $plain,
        'found' => $pat ? true : false,
        'token_row' => $pat ? $pat->toArray() : null,
        'auth_user' => Auth::user() ? Auth::user()->toArray() : null,
    ]);
});
