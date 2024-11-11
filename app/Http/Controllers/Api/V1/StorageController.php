<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Domains\Storage\UseCases\UploadFileUseCase;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Storage\FileResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    /**
     * @param Request $request
     * @param UploadFileUseCase $uploadFileUseCase
     *
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function upload(Request $request, UploadFileUseCase $uploadFileUseCase): JsonResponse
    {
        $files = $uploadFileUseCase->execute($request->user(), ...$request->file('images'));
        return FileResource::collection($files)->response();
    }

}
