<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\User\MeResource;
use App\UseCases\User\UserInformationGetUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @param UserInformationGetUseCase $useCase
     *
     * @return JsonResource
     */
    public function me(Request $request, UserInformationGetUseCase $useCase): JsonResource
    {
        return new MeResource($useCase->execute($request->user()));
    }
}
