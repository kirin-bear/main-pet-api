<?php

declare(strict_types=1);

namespace App\Domains\Notion\ValueObject;

class DatabaseDescription
{
    private string $url;
    private bool $inTrash;
    private array $rawData;

    public function __construct(string $url, bool $inTrash, array $rawData)
    {
        $this->url = $url;
        $this->inTrash = $inTrash;
        $this->rawData = $rawData;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function isInTrash(): bool
    {
        return $this->inTrash;
    }

    public function getRawData(): array
    {
        return $this->rawData;
    }

}
