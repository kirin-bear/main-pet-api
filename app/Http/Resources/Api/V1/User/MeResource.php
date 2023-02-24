<?php

namespace App\Http\Resources\Api\V1\User;

use App\Http\Resources\AbstractResource;
use App\Models\KirinBear\User;

/**
 * @property User $resource
 */
class MeResource extends AbstractResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'email' => $this->resource->email
        ];
    }
}
