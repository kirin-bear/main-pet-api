<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1\Memory;

use App\Domains\Memories\Entities\MemoryLink;
use App\Http\Resources\AbstractResource;

/**
 * @property MemoryLink $resource
 */
class MemoryLinkResource extends AbstractResource
{
    /**
     * @param $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'target_id' => $this->resource->getTargetId(),
            'source_id' => $this->resource->getSourceId(),
            'weight' => 2,
        ];
    }

}
