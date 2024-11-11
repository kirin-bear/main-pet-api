<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1\Storage;

use App\Domains\Storage\Dto\FileDto;
use App\Http\Resources\AbstractResource;

/**
 * @property FileDto $resource
 */
class FileResource extends AbstractResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->resource->getName(),
            'url' => $this->resource->getUrl(),
        ];
    }
}
