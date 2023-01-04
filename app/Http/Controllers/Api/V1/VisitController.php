<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\UseCase\Visit\VisitStoreUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitController extends Controller
{

    public function store(Request $request, VisitStoreUseCase $sessionStoreUseCase): JsonResponse
    {
        $result = $sessionStoreUseCase->execute(
            $request->getUri(),
            is_string($request->header('referer')) ? $request->header('referer') : ''
        );
        return response()->json($result);
    }

}
