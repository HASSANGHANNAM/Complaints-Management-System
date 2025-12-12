<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\FileStorageController;
use App\Http\Controllers\Api\GovernmentAgencyController;
use App\Http\Controllers\Api\MediaController;
use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'verified.email'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/getProfile', [AuthController::class, 'getProfile']);
    Route::get('/users/{id}/{face}', [FileStorageController::class, 'viewIdPhoto']);
    Route::get('/media/{id}', [FileStorageController::class, 'viewMedia']);
    Route::post('/createComplaint', [ComplaintController::class, 'createComplaint'])->middleware(['permission:create complaints']);
    Route::get('/myComplaints', [ComplaintController::class, 'myComplaints'])->middleware(['permission:get my complaints']);
    Route::get('/getComplaintDetails/{id}', [ComplaintController::class, 'getComplaintDetails']);
    Route::get('/getAgencies', [GovernmentAgencyController::class, 'getAgencies'])->middleware(['permission:get agencies']);
    Route::get('/getAgency/{id}/sections', [GovernmentAgencyController::class, 'getSections'])->middleware(['permission:get agency sections']);

    Route::prefix('agencies')->group(function () {
        Route::get('/search', [GovernmentAgencyController::class, 'search']);
        //! POST route for creating agency
        Route::post('/', [GovernmentAgencyController::class, 'store']);
        //! Routes for agency by Id
        Route::prefix('{id}')->group(function () {
            //! GET single agency
            Route::get('/', [GovernmentAgencyController::class, 'show']);
            //! PUT/PATCH for updating agency
            Route::put('/', [GovernmentAgencyController::class, 'update']);
            Route::patch('/', [GovernmentAgencyController::class, 'update']);
            Route::delete('/', [GovernmentAgencyController::class, 'destroy']);
        });
    });
});
