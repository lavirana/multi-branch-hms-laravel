<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {

    // Is the API running?
    Route::get('/ping', function () {
        return response()->json([
            'success' => true,
            'message' => 'Hospital API is running',
            'time' => now()->toIso8601String(),
        ]);
    });

    // Is MongoDB connected? (for testing only, remove later)
    Route::get('/ping-db', function () {
        DB::connection('mongodb')
            ->getMongoClient()
            ->selectDatabase('admin')
            ->command(['ping' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'MongoDB is connected',
        ]);
    });
});