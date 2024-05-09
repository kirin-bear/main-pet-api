<?php

declare(strict_types=1);

namespace App\Domains\Notion\Entities;

use App\Domains\Notion\Enums\ParentObjectTypeEnum;

class ParentObject
{
    private string $uuid;

    private string $type;

    public function __construct(string $uuid, ParentObjectTypeEnum $type)
    {
        $this->uuid = $uuid;
        $this->type = $type->value;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getType(): string
    {
        return $this->type;
    }

}
