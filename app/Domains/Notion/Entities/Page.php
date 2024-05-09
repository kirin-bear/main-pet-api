<?php

declare(strict_types=1);

namespace App\Domains\Notion\Entities;

use App\Domains\Notion\ValueObject\PageDescription;

class Page
{
    private string $uuid;
    private string $title;
    private array $properties;
    private ParentObject $parentObject;
    private PageDescription $description;

    public function __construct(string $uuid, string $title, array $properties, ParentObject $parentObject, PageDescription $description)
    {
        $this->uuid = $uuid;
        $this->title = $title;
        $this->properties = $properties;
        $this->parentObject = $parentObject;
        $this->description = $description;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getProperties(): array
    {
        return $this->properties;
    }

    public function getParentObject(): ParentObject
    {
        return $this->parentObject;
    }

    public function getDescription(): PageDescription
    {
        return $this->description;
    }

}
