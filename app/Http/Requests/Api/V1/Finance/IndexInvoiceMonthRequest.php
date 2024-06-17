<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Finance;

use App\Http\Requests\AbstractFormRequest;

class IndexInvoiceMonthRequest extends AbstractFormRequest
{
    public function rules(): array
    {
        return [
            'type' => 'required|string',
        ];
    }

}
