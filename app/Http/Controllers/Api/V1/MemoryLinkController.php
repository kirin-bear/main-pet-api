<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Domains\Memories\UseCases\MemoryLinkIndexUseCase;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Memory\MemoryLinkResource;
use Illuminate\Http\JsonResponse;

class MemoryLinkController extends Controller
{
    /**
     * @param MemoryLinkIndexUseCase $memoryLinkIndexUseCase
     *
     * @return JsonResponse
     */
    public function index(MemoryLinkIndexUseCase $memoryLinkIndexUseCase): JsonResponse
    {
        return MemoryLinkResource::collection($memoryLinkIndexUseCase->execute())->response();
    }
}
