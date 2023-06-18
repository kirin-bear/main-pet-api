<?php

declare(strict_types=1);

namespace App\UseCases\Memory;

use App\Domains\Memories\Entities\MemoryLink;
use App\Domains\Memories\Services\EntitiesGenerator;

class MemoryLinkIndexUseCase
{
    private EntitiesGenerator $entitiesGenerator;

    public function __construct(EntitiesGenerator $entitiesGenerator)
    {
        $this->entitiesGenerator = $entitiesGenerator;
    }

    /**
     * @return MemoryLink[]
     */
    public function execute(): array
    {
        return $this->entitiesGenerator->memoriesLinks(1, 50, 5);
    }

}
