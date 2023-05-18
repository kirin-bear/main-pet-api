<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Memory\MemoryResource;
use App\UseCases\Memory\MemoryIndexUseCase;
use Illuminate\Http\JsonResponse;

class MemoryController extends Controller
{

    /**
     * @param MemoryIndexUseCase $memoryIndexUseCase
     *
     * @return JsonResponse
     */
    public function index(MemoryIndexUseCase $memoryIndexUseCase): JsonResponse
    {
        return MemoryResource::collection($memoryIndexUseCase->execute())->response();
    }

}
