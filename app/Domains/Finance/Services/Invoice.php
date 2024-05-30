<?php

declare(strict_types=1);

namespace App\Domains\Finance\Services;

use App\Domains\Finance\Factories\InvoiceMonthFactory;
use App\Domains\Finance\ValueObject\InvoiceMonth;
use Carbon\Carbon;
use Exception;

class Invoice
{
    private InvoiceMonthFactory $invoiceMonthFactory;

    public function __construct(InvoiceMonthFactory $invoiceMonthFactory)
    {
        $this->invoiceMonthFactory = $invoiceMonthFactory;
    }

    /**
     * @param string $type
     * @param Carbon $from
     * @param Carbon $to
     *
     * @return InvoiceMonth[]
     * @throws Exception
     */
    public function getMonthsRandomize(string $type, Carbon $from, Carbon $to): array
    {
        $invoices = [];

        while ($from->lessThanOrEqualTo($to)) {
            $invoices[] = $this->invoiceMonthFactory->make($type, $from->format('M'), random_int(0, 200000));
            $from->addMonth();
        }

        return $invoices;
    }

}
