<?php

declare(strict_types=1);

namespace App\Domains\Notion\Dto;

use App\Domains\Notion\Enums\PropertyTypeEnum;

class RollupPropertyParams
{
    private PropertyTypeEnum $type;
    private mixed $value;
    private string $function;

    public function __construct(PropertyTypeEnum $type, mixed $value, string $function)
    {
        $this->type = $type;
        $this->value = $value;
        $this->function = $function;
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
            $array['function']
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

    public function getFunction(): string
    {
        return $this->function;
    }

}
