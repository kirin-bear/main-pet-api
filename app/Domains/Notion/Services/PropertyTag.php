<?php

declare(strict_types=1);

namespace App\Domains\Notion\Services;

class PropertyTag
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param string $uuid
     * @return string[];
     */
    public function getTagsByDatabaseUuid(string $uuid): array
    {
        return array_keys($this->data[$uuid] ?? []);
    }

    /**
     * @param string $uuid
     * @param string $tag
     *
     * @return string[]
     */
    public function getPropertiesByDatabaseAndTag(string $uuid, string $tag): array
    {
        return $this->data[$uuid][$tag] ?? [];
    }

}
