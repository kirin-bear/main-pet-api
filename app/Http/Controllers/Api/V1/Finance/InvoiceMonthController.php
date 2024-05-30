<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Finance;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Finance\InvoiceMonthResponse;
use App\UseCases\Finance\InvoiceMonthIndexUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;

class InvoiceMonthController extends Controller
{
    /**
     * @param InvoiceMonthIndexUseCase $invoiceMonthIndexUseCase
     * @param Request $request
     * @return JsonResponse
     *
     * @throws JsonException
     */
    public function index(InvoiceMonthIndexUseCase $invoiceMonthIndexUseCase, Request $request): JsonResponse
    {
        return InvoiceMonthResponse::collection($invoiceMonthIndexUseCase->execute($request->user()->id))
            ->response();
    }

}
