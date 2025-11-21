<?php

use App\Http\Controllers\Api\AuthController;
use App\Models\User;
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
    Route::get('/users/{id}/id-front', function ($id) {
        $user = User::findOrFail($id);
        if (!$user->IdFrontFace) {
            return response()->json(['error' => 'صورة الهوية الأمامية غير موجودة'], 404);
        }
        if (!Storage::disk('secure_documents')->exists($user->IdFrontFace)) {
            return response()->json(['error' => 'ملف الصورة غير موجود في التخزين'], 404);
        }
        $fileContent = Storage::disk('secure_documents')->get($user->IdFrontFace);
        $extension = pathinfo($user->IdFrontFace, PATHINFO_EXTENSION);
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'pdf' => 'application/pdf',
        ];
        $mimeType = $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';

        return response($fileContent)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="id-front.' . $extension . '"');
    });
    Route::get('/users/{id}/id-back', function ($id) {
        $user = User::findOrFail($id);
        if (!$user->IdBackFace) {
            return response()->json(['error' => 'صورة الهوية الخلفية غير موجودة'], 404);
        }
        if (!Storage::disk('secure_documents')->exists($user->IdBackFace)) {
            return response()->json(['error' => 'ملف الصورة غير موجود في التخزين'], 404);
        }
        $fileContent = Storage::disk('secure_documents')->get($user->IdBackFace);
        $extension = pathinfo($user->IdBackFace, PATHINFO_EXTENSION);
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'pdf' => 'application/pdf',
        ];
        $mimeType = $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';
        return response($fileContent)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="id-back.' . $extension . '"');
    });
});
