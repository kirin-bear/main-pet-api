<?php

declare(strict_types=1);

namespace App\UseCases\Notion;

use App\Domains\Notion\Services\Api;

class PagesSyncUseCase
{
    private Api $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    public function execute(string ...$uuids): bool
    {
        return true;
    }

}
