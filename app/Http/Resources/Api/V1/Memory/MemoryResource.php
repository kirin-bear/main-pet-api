<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1\Memory;

use App\Domains\Memories\Entities\Memory;
use App\Http\Resources\AbstractResource;

/**
 * @property Memory $resource
 */
class MemoryResource extends AbstractResource
{
    /**
     * @param $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->getId(),
            'title' => $this->resource->getTitle(),
        ];
    }

}
