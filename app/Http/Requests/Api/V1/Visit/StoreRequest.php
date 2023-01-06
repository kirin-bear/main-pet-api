<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Visit;

use App\Http\Requests\AbstractFormRequest;

class StoreRequest extends AbstractFormRequest
{
    public function rules(): array
    {
        return [
            'page' => 'required|string|min:10',
            'referer' => 'required|string|min:10',
        ];
    }

    /**
     * @return string
     */
    public function getRefererValue(): string
    {
        return $this->get('referer') ?? '';
    }

    public function getPageValue(): string
    {
        return $this->get('page') ?? '';
    }
}
