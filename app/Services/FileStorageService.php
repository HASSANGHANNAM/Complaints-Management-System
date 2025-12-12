<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\Storage;

class FileStorageService
{

    public function viewIdPhoto($id, $face)
    {
        $user = User::findOrFail($id);
        if ($face == "id-front") {
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
        } else if ($face == "id-back") {
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
        }
    }
    public function viewMedia($id)
    {
        try {
            $media = \App\Models\Media::find($id);

            if (!$media) {
                return response()->json(['error' => 'السجل غير موجود'], 404);
            }

            if (!$media->Media) {
                return response()->json(['error' => 'مسار الملف غير موجود في السجل'], 404);
            }

            $dbPath = $media->Media;
            $uuid = pathinfo($dbPath, PATHINFO_FILENAME);
            $uuid = str_replace('student_documents_', '', $uuid);
            $extension = pathinfo($dbPath, PATHINFO_EXTENSION);
            $year = date('Y', strtotime($media->created_at ?? now()));
            $month = date('m', strtotime($media->created_at ?? now()));
            $correctFileName = $uuid . '.' . $extension;
            $correctedPath = "complaints/{$year}/{$month}/{$correctFileName}";

            $fullPath = storage_path("app/private/documents/{$correctedPath}");

            if (!file_exists($fullPath)) {
                $searchPath = storage_path("app/private/documents/complaints/{$year}/{$month}/");
                $files = scandir($searchPath);
                $foundFile = null;

                foreach ($files as $file) {
                    if (str_contains($file, $uuid)) {
                        $foundFile = $file;
                        $correctedPath = "complaints/{$year}/{$month}/{$file}";
                        $fullPath = storage_path("app/private/documents/{$correctedPath}");
                        break;
                    }
                }

                if (!$foundFile) {
                    return response()->json([
                        'error' => 'الملف غير موجود',
                        'debug' => [
                            'db_path' => $dbPath,
                            'uuid' => $uuid,
                            'searched_path' => $fullPath,
                            'available_files' => array_slice($files, 2)
                        ]
                    ], 404);
                }
            }

            return response()->file($fullPath, [
                'Content-Type' => mime_content_type($fullPath),
                'Content-Disposition' => 'inline; filename="' . basename($correctedPath) . '"'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'حدث خطأ',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}


    // Route::get('/users/{id}/id-front', function ($id) {
    //     $user = User::findOrFail($id);
    //     if (!$user->IdFrontFace) {
    //         return response()->json(['error' => 'صورة الهوية الأمامية غير موجودة'], 404);
    //     }
    //     if (!Storage::disk('secure_documents')->exists($user->IdFrontFace)) {
    //         return response()->json(['error' => 'ملف الصورة غير موجود في التخزين'], 404);
    //     }
    //     $fileContent = Storage::disk('secure_documents')->get($user->IdFrontFace);
    //     $extension = pathinfo($user->IdFrontFace, PATHINFO_EXTENSION);
    //     $mimeTypes = [
    //         'jpg' => 'image/jpeg',
    //         'jpeg' => 'image/jpeg',
    //         'png' => 'image/png',
    //         'gif' => 'image/gif',
    //         'pdf' => 'application/pdf',
    //     ];
    //     $mimeType = $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';

    //     return response($fileContent)
    //         ->header('Content-Type', $mimeType)
    //         ->header('Content-Disposition', 'inline; filename="id-front.' . $extension . '"');
    // })->middleware(['permission:view posts']);;
    // Route::get('/users/{id}/id-back', function ($id) {
    //     $user = User::findOrFail($id);
    //     if (!$user->IdBackFace) {
    //         return response()->json(['error' => 'صورة الهوية الخلفية غير موجودة'], 404);
    //     }
    //     if (!Storage::disk('secure_documents')->exists($user->IdBackFace)) {
    //         return response()->json(['error' => 'ملف الصورة غير موجود في التخزين'], 404);
    //     }
    //     $fileContent = Storage::disk('secure_documents')->get($user->IdBackFace);
    //     $extension = pathinfo($user->IdBackFace, PATHINFO_EXTENSION);
    //     $mimeTypes = [
    //         'jpg' => 'image/jpeg',
    //         'jpeg' => 'image/jpeg',
    //         'png' => 'image/png',
    //         'gif' => 'image/gif',
    //         'pdf' => 'application/pdf',
    //     ];
    //     $mimeType = $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';
    //     return response($fileContent)
    //         ->header('Content-Type', $mimeType)
    //         ->header('Content-Disposition', 'inline; filename="id-back.' . $extension . '"');
    // });




    //  Route::get('/media/{id}', function ($id) {
    //     try {
    //         $media = \App\Models\Media::find($id);

    //         if (!$media) {
    //             return response()->json(['error' => 'السجل غير موجود'], 404);
    //         }

    //         if (!$media->Media) {
    //             return response()->json(['error' => 'مسار الملف غير موجود في السجل'], 404);
    //         }

    //         // استخرج UUID من المسار المخزن في قاعدة البيانات
    //         $dbPath = $media->Media;
    //         $uuid = pathinfo($dbPath, PATHINFO_FILENAME); // student_documents_3b7e2a1f-2c44-4a9b-a2f1-1b2c3d4e5f60
    //         $uuid = str_replace('student_documents_', '', $uuid); // 3b7e2a1f-2c44-4a9b-a2f1-1b2c3d4e5f60

    //         // احصل على الامتداد
    //         $extension = pathinfo($dbPath, PATHINFO_EXTENSION); // pdf

    //         // ابن المسار الصحيح بناءً على الهيكل الفعلي
    //         $year = date('Y', strtotime($media->created_at ?? now()));
    //         $month = date('m', strtotime($media->created_at ?? now()));
    //         $correctFileName = $uuid . '.' . $extension;
    //         $correctedPath = "complaints/{$year}/{$month}/{$correctFileName}";

    //         $fullPath = storage_path("app/private/documents/{$correctedPath}");

    //         if (!file_exists($fullPath)) {
    //             // إذا لم يعثر، حاول البحث عن أي ملف بهذا UUID في المجلد
    //             $searchPath = storage_path("app/private/documents/complaints/{$year}/{$month}/");
    //             $files = scandir($searchPath);
    //             $foundFile = null;

    //             foreach ($files as $file) {
    //                 if (str_contains($file, $uuid)) {
    //                     $foundFile = $file;
    //                     $correctedPath = "complaints/{$year}/{$month}/{$file}";
    //                     $fullPath = storage_path("app/private/documents/{$correctedPath}");
    //                     break;
    //                 }
    //             }

    //             if (!$foundFile) {
    //                 return response()->json([
    //                     'error' => 'الملف غير موجود',
    //                     'debug' => [
    //                         'db_path' => $dbPath,
    //                         'uuid' => $uuid,
    //                         'searched_path' => $fullPath,
    //                         'available_files' => array_slice($files, 2) // استبعد . و ..
    //                     ]
    //                 ], 404);
    //             }
    //         }

    //         return response()->file($fullPath, [
    //             'Content-Type' => mime_content_type($fullPath),
    //             'Content-Disposition' => 'inline; filename="' . basename($correctedPath) . '"'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => 'حدث خطأ',
    //             'message' => $e->getMessage()
    //         ], 500);
    //     }
    // });