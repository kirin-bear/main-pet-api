<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Finance;

use App\Domains\Finance\UseCases\GetInvoiceMonthUseCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Finance\IndexInvoiceMonthRequest;
use App\Http\Resources\Api\V1\Finance\InvoiceMonthResponse;
use Illuminate\Http\JsonResponse;
use JsonException;

class InvoiceMonthController extends Controller
{
    /**
     * @param GetInvoiceMonthUseCase $useCase
     * @param IndexInvoiceMonthRequest $request
     * @return JsonResponse
     *
     * @throws JsonException
     */
    public function index(GetInvoiceMonthUseCase $useCase, IndexInvoiceMonthRequest $request): JsonResponse
    {
        return InvoiceMonthResponse::collection(
            $useCase->execute(
                $request->user()->id, $request->get('type')
            )
        )->response();
    }

}
