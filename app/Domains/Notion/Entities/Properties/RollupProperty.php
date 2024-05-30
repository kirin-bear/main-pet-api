<?php

declare(strict_types=1);

namespace App\Domains\Notion\Entities\Properties;

use App\Domains\Notion\Dto\RollupPropertyParams;

class RollupProperty extends AbstractProperty
{
    private string $id;
    private string $type;
    private RollupPropertyParams $params;
    private string $name;

    public function __construct(string $id, string $name, string $type, array $params)
    {
        $this->id = $id;
        $this->type = $type;
        $this->params = RollupPropertyParams::fromArray($params);
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): mixed
    {
        return $this->params->getValue();
    }

    public function getName(): string
    {
        return $this->name;
    }
}
