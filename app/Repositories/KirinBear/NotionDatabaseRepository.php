<?php

declare(strict_types=1);

namespace App\Repositories\KirinBear;

use App\Models\KirinBear\NotionDatabase;
use App\Repositories\AbstractModelRepository;

/**
 * @method NotionDatabase newModel()
 */
class NotionDatabaseRepository extends AbstractModelRepository
{
    public function getClassName(): string
    {
        return NotionDatabase::class;
    }
}
