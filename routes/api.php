<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::get('/ping', fn () => response()->json([
        'success' => true,
        'message' => 'Hospital API is running',
        'time' => now()->toIso8601String(),
    ]));

    // public route: 5 tries per minute
    Route::post('/auth/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1');

    // routes for any logged-in user
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/me', [AuthController::class, 'me']);

        // test route: only admins (uses the RoleMiddleware from the Start here section)
        Route::middleware('role:super_admin,branch_admin')
            ->get('/admin/ping', fn () => response()->json([
                'success' => true,
                'message' => 'Welcome, admin',
            ]));
    });
});