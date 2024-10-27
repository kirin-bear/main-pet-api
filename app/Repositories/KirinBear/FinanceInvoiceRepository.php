<?php

declare(strict_types=1);

namespace App\Repositories\KirinBear;

use App\Models\KirinBear\FinanceInvoice;
use App\Repositories\AbstractModelRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * @method FinanceInvoice newModel()
 */
class FinanceInvoiceRepository extends AbstractModelRepository
{
    public function getClassName(): string
    {
        return FinanceInvoice::class;
    }


    /**
     * @param int $userId
     * @param string $type
     * @return Collection|FinanceInvoice[]
     */
    public function getInvoicesMonth(int $userId, string $type): Collection|array
    {
        return $this->createQueryBuilder()
            ->where('user_id', $userId)
            ->where('type', $type)
            ->whereRaw("DATE_FORMAT(`from`, '%Y%m') = DATE_FORMAT(`till`, '%Y%m')")
            ->orderBy('from')
            ->get();
    }
}
