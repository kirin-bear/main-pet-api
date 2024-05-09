<?php

declare(strict_types=1);

namespace App\Repositories\KirinBear;

use App\Models\AbstractModel;
use App\Models\KirinBear\NotionPage;
use App\Repositories\AbstractModelRepository;

/**
 * @method NotionPage newModel()
 */
class NotionPageRepository extends AbstractModelRepository
{

    public function getClassName(): string
    {
        return NotionPage::class;
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
