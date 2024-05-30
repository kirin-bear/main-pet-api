<?php

declare(strict_types=1);

namespace App\Domains\Notion\Entities\Properties;

class RelationProperty extends AbstractProperty
{
    private string $id;
    private string $type;
    private array $params;
    private string $name;

    public function __construct(string $id, string $name, string $type, array $params)
    {
        $this->id = $id;
        $this->type = $type;
        $this->params = $params;
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

    public function getValue(): array
    {
        return $this->params;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
