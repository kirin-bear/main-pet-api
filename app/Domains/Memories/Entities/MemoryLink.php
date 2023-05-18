<?php

declare(strict_types=1);

namespace App\Domains\Memories\Entities;

class MemoryLink
{
    private int $sourceId;
    private int $targetId;

    public function __construct(int $sourceId, int $targetId)
    {
        $this->sourceId = $sourceId;
        $this->targetId = $targetId;
    }

    /**
     * @return int
     */
    public function getSourceId(): int
    {
        return $this->sourceId;
    }

    /**
     * @return int
     */
    public function getTargetId(): int
    {
        return $this->targetId;
    }

}
