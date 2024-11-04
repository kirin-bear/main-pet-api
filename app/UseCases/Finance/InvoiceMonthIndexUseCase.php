<?php

declare(strict_types=1);

namespace App\UseCases\Finance;

use App\Domains\Finance\Factories\InvoiceMonthFactory;
use App\Domains\Finance\Services\Invoice;
use App\Domains\Finance\ValueObject\InvoiceMonth;
use App\Domains\Notion\Enums\PageUuidEnums;
use App\Domains\Notion\Enums\PropertyTypeEnum;
use App\Domains\Notion\Services\PropertyTag;
use App\Domains\Notion\Services\Transformer;
use App\Helpers\DateHelper;
use App\Models\KirinBear\NotionPage;
use App\Models\KirinBear\User;
use App\Repositories\KirinBear\FinanceInvoiceRepository;
use App\Repositories\KirinBear\NotionPageRepository;
use Carbon\Carbon;

class InvoiceMonthIndexUseCase
{
    private InvoiceMonthFactory $invoiceMonthFactory;
    private FinanceInvoiceRepository $financeInvoiceRepository;

    public function __construct(
        InvoiceMonthFactory $invoiceMonthFactory,
        FinanceInvoiceRepository $financeInvoiceRepository
    ) {
        $this->invoiceMonthFactory = $invoiceMonthFactory;
        $this->financeInvoiceRepository = $financeInvoiceRepository;
    }

    /**
     * @param int $userId
     * @param string $type
     *
     * @return InvoiceMonth[]
     *
     */
    public function execute(int $userId, string $type): array
    {
        $monthInvoices = [];
        // получим месячные отчеты
        $invoices = $this->financeInvoiceRepository->getInvoicesMonth($userId, $type);

        foreach ($invoices as $invoice) {
            $monthInvoices[] = $this->invoiceMonthFactory->make(
                $invoice->name,
                Carbon::createFromTimeString($invoice->from)->format('M Y'),
                $invoice->total,
                $invoice->type
            );
        }

        return $monthInvoices;
    }

}
