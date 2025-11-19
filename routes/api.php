<?php

use App\Http\Controllers\Api\AuthController;
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


Route::post('/registerUser', [AuthController::class, 'registerUser']);
Route::post('/refreshToken', [AuthController::class, 'refreshToken']);
Route::post('/resend', [AuthController::class, 'resendCode']);
Route::post('/verify', [AuthController::class, 'verifyCode']);

// Route::post('/login', [AuthController::class, 'login'])
//      ->middleware('verified.email');
Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['auth:sanctum', 'verified.email'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
