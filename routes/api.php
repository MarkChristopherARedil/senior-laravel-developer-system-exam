<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Login (Generate Auth Token)
Route::post('/v1/login', [AuthController::class, 'login']);

// Auth Sanctum Middleware
Route::middleware('auth:sanctum')->prefix('v1')->group(function() {
    Route::prefix('projects')->group(function() {
        Route::get('/',  [ProjectController::class, 'index']);
        Route::get('/{project}', [ProjectController::class, 'show']);
        Route::post('/store', [ProjectController::class, 'store']);
        Route::put('/{project}', [ProjectController::class, 'update']);
        Route::delete('/{project}', [ProjectController::class, 'destroy']);
    });

    // logout (Remove Auth Token)
    Route::get('/logout', [AuthController::class, 'logout']);
});
