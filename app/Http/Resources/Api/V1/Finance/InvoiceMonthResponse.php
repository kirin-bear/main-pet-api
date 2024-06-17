<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1\Finance;

use App\Domains\Finance\ValueObject\InvoiceMonth;
use App\Http\Resources\AbstractResource;

/**
 * @property InvoiceMonth $resource
 */
class InvoiceMonthResponse extends AbstractResource
{
    /**
     * @param $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->resource->getName(),
            'month' => $this->resource->getMonth(),
            'count' => $this->resource->getCount(),
            'type' => $this->resource->getType(),
        ];
    }

}
