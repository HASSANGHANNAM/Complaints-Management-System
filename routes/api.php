<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminComplaintController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\SystemAdminController;
use App\Models\User;
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


Route::post('/login', [AuthController::class, 'login']);

// ->middleware([ 'permission:view posts']);

Route::middleware(['auth:sanctum', 'verified.email'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/getProfile', [AuthController::class, 'getProfile']);

    Route::prefix('complaints')->group(function () {
    Route::post('/createComplaint', [ComplaintController::class, 'createComplaint']);
    Route::get('/getComplaint/{id}', [ComplaintController::class, 'getComplaint']);
    Route::get('/myComplaints', [ComplaintController::class, 'myComplaints']);
    Route::post('/{id}/attachments', [ComplaintController::class, 'addAttachment']);
    Route::get('/{id}/tracking', [ComplaintController::class, 'ComplaintTracking']);
});
Route::prefix('admin/complaints')->group(function () {
    Route::get('/AllComplaints', [AdminComplaintController::class, 'getAllComplaints']);
    Route::put('/{id}/status', [AdminComplaintController::class, 'updateStatus']);
    Route::post('/{id}/notes', [AdminComplaintController::class, 'addNote']);
});
Route::prefix('system-admin')->group(function () {
    Route::get('/stats', [SystemAdminController::class, 'SystemStats']);
    Route::get('/export', [SystemAdminController::class, 'exportData']);
    Route::post('/agencies', [SystemAdminController::class, 'manageAgencies']);
    Route::post('/users', [SystemAdminController::class, 'createUser']);
});

    Route::middleware(['permission:agencyManager'])->group(function () {

        Route::post('/createEmployee', [GovernmentAgencyEmployeeController::class, 'createEmployee']);
        Route::put('/updateEmployee/{id}', [GovernmentAgencyEmployeeController::class, 'updateEmployee']);
        Route::delete('/deleteEmployee/{id}', [GovernmentAgencyEmployeeController::class, 'deleteEmployee']);
        Route::get('/getEmployee/{id}', [GovernmentAgencyEmployeeController::class, 'getEmployee']);
        Route::get('/employees', [GovernmentAgencyEmployeeController::class, 'listEmployees']);

        Route::post('/create-services/{id}', [GovernmentAgencySectionServiceController::class, 'create']);
        Route::put('/update-services/{id}', [GovernmentAgencySectionServiceController::class, 'update']);
        Route::delete('/delete-services/{id}', [GovernmentAgencySectionServiceController::class, 'delete']);
        Route::get('/find-services/{id}', [GovernmentAgencySectionServiceController::class, 'find']);
        // Route::get('/list-services', [GovernmentAgencySectionServiceController::class, 'list']);

        Route::post('/createSection', [GovernmentAgencySectionController::class, 'create']);
        Route::put('/updateSection/{id}', [GovernmentAgencySectionController::class, 'update']);
        Route::delete('/deleteSection/{id}', [GovernmentAgencySectionController::class, 'delete']);
        Route::get('/findSection/{id}', [GovernmentAgencySectionController::class, 'get']);
        Route::get('/listSection', [GovernmentAgencySectionController::class, 'list']);
    });

    // Route::middleware(['permission:employee'])->group(function () {
        Route::post('/updateComplaintsStatus/{complaintId}', [ComplaintStatusController::class, 'updateStatus']);
    // });

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
    })->middleware(['permission:view posts']);;
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
