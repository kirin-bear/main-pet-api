<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\UseCase\Session\SessionStoreUseCase;
use Illuminate\Http\JsonResponse;

class SessionController extends Controller
{

    public function store(SessionStoreUseCase $sessionStoreUseCase): JsonResponse
    {
        return response()->json($sessionStoreUseCase->execute());
    }

}
