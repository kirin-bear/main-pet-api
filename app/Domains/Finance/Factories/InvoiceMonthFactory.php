<?php

declare(strict_types=1);

namespace App\Domains\Finance\Factories;

use App\Domains\Finance\ValueObject\InvoiceMonth;

class InvoiceMonthFactory
{
    /**
     * @param string $name
     * @param string $month
     * @param int $count
     *
     * @return InvoiceMonth
     */
    public function make(string $name, string $month, int $count): InvoiceMonth
    {
        return new InvoiceMonth($name, $month, $count);
    }

}
