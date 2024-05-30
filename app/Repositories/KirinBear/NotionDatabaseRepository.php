<?php

declare(strict_types=1);

namespace App\Repositories\KirinBear;

use App\Models\KirinBear\NotionDatabase;
use App\Repositories\AbstractModelRepository;

/**
 * @method NotionDatabase newModel()
 * @method NotionDatabase|null find(string|int $id)
 */
class NotionDatabaseRepository extends AbstractModelRepository
{
    public function getClassName(): string
    {
        return NotionDatabase::class;
    }

    /**
     * @param int $id
     *
     * @return int
     */
    public function getCountByUserId(int $id): int
    {
        return $this->createQueryBuilder()
            ->where('user_id', $id)
            ->count();
    }
}
