<?php

namespace App\Http\Resources\Api\V1\User;

use App\Http\Resources\AbstractResource;
use App\UseCases\User\Dto\User;

/**
 * @property User $resource
 */
class MeResource extends AbstractResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->getId(),
            'email' => $this->resource->getEmail(),
            'notion_count_databases' => $this->resource->getCountNotionDatabases(),
            'notion_count_pages' => $this->resource->getCountNotionPages(),
        ];
    }
}
