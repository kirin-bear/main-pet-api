<?php

declare(strict_types=1);

namespace App\Domains\Alisa\ValueObject;

class Session
{
    private string $id;
    private bool $isNew;

    public function __construct(string $id, bool $isNew)
    {
        $this->id = $id;
        $this->isNew = $isNew;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function isNew(): bool
    {
        return $this->isNew;
    }

}
