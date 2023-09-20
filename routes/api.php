<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('user')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('auth-user')->middleware('auth:sanctum')->group( function () {
    Route::get('list', [AuthController::class, 'userList']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('blogs', BlogController::class)->only(['index', 'create', 'store', 'edit', 'update']);

    
});
