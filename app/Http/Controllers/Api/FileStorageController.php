<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Complaints\CreateComplaintRequest;
use App\Http\Requests\Complaints\AddAttachmentRequest;
use App\Http\Requests\MyComplaintsRequest;

use App\Services\ComplaintService;
use App\Http\Responses\Response;
use App\Services\FileStorageService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

class FileStorageController extends Controller
{
    private FileStorageService $fileStorageService;

    public function __construct(FileStorageService $fileStorageService)
    {
        $this->fileStorageService = $fileStorageService;
    }

    public function viewIdPhoto($id, $face)
    {
        try {
            return $this->fileStorageService->viewIdPhoto($id, $face);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }
    public function viewMedia($id)
    {
        try {
            return $this->fileStorageService->viewMedia($id);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }
    // public function createComplaint(CreateComplaintRequest $request): JsonResponse
    // {
    //     try {
    //         $data = $this->fileStorageService->createComplaint($request->validated());
    //         return Response::success($data['data'], $data['message'], $data['code']);
    //     } catch (Throwable $th) {
    //         return Response::Error([], $th->getMessage());
    //     }
    // }
}
