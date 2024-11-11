<?php

declare(strict_types=1);

namespace App\Http\Controllers\Webhooks\Alisa;

use App\Domains\Alisa\UseCases\HandleRequestUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RequestController extends Controller
{

    public function store(Request $request, HandleRequestUseCase $useCase): JsonResponse
    {
        return response()
            ->json(
                $useCase->execute($request->all()),
            );
    }
}
