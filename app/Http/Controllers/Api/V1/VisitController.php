<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Visit\StoreRequest;
use App\UseCases\Visit\VisitStoreUseCase;
use Illuminate\Http\JsonResponse;

class VisitController extends Controller
{

    /**
     * @param StoreRequest $request
     * @param VisitStoreUseCase $sessionStoreUseCase
     *
     * @return JsonResponse
     */
    public function store(StoreRequest $request, VisitStoreUseCase $sessionStoreUseCase): JsonResponse
    {
        $id = $sessionStoreUseCase->execute(
            $request->getPageValue(),
            $request->getRefererValue(),
            $request->getClientIp() ?? ''
        );

        return response()->json(['id' => $id]);
    }

}
