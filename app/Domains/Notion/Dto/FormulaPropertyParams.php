<?php

declare(strict_types=1);

namespace App\Domains\Notion\Dto;

use App\Domains\Notion\Enums\PropertyTypeEnum;

class FormulaPropertyParams
{
    private PropertyTypeEnum $type;
    private mixed $value;

    public function __construct(PropertyTypeEnum $type, mixed $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * @param array $array
     *
     * @return self
     */
    public static function fromArray(array $array): self
    {
        return new self(
            PropertyTypeEnum::from($array['type'] ?? ''),
            $array[$array['type']],
        );
    }

    public function getType(): string
    {
        return $this->type->value;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }
}
