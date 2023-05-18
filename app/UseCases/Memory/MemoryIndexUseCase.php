<?php

declare(strict_types=1);

namespace App\UseCases\Memory;

use App\Domains\Memories\Entities\Memory;
use App\Domains\Memories\Services\EntitiesGenerator;

class MemoryIndexUseCase
{
    private EntitiesGenerator $entitiesGenerator;

    public function __construct(EntitiesGenerator $entitiesGenerator)
    {
        $this->entitiesGenerator = $entitiesGenerator;
    }

    /**
     * @return Memory[]
     */
    public function execute(): array
    {
        return $this->entitiesGenerator->memories(1, 100);
    }

}
