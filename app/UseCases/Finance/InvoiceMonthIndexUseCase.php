<?php

declare(strict_types=1);

namespace App\UseCases\Finance;

use App\Domains\Finance\Factories\InvoiceMonthFactory;
use App\Domains\Finance\Services\Invoice;
use App\Domains\Finance\ValueObject\InvoiceMonth;
use App\Domains\Notion\Enums\PageUuidEnums;
use App\Domains\Notion\Enums\PropertyTypeEnum;
use App\Domains\Notion\Services\Transformer;
use App\Helpers\DateHelper;
use App\Models\KirinBear\NotionPage;
use App\Models\KirinBear\User;
use App\Repositories\KirinBear\NotionPageRepository;
use Carbon\Carbon;

class InvoiceMonthIndexUseCase
{
    private InvoiceMonthFactory $invoiceMonthFactory;
    private NotionPageRepository $notionPageRepository;
    private Transformer $transformer;

    public function __construct(InvoiceMonthFactory $invoiceMonthFactory, NotionPageRepository $notionPageRepository, Transformer $transformer)
    {

        $this->invoiceMonthFactory = $invoiceMonthFactory;
        $this->notionPageRepository = $notionPageRepository;
        $this->transformer = $transformer;
    }

    /**
     * @return InvoiceMonth[]
     *
     * @throws \JsonException
     */
    public function execute(int $userId): array
    {
        $invoices = [];
        $months = $this->notionPageRepository
            ->getByUserAndParentUuid($userId, PageUuidEnums::MonthReportUuid->value)
            ->sortBy(function (NotionPage $notionPage) {
                // сортируем относительно названия
                $explode = explode(' ', $notionPage->title);
                return Carbon::createFromDate($explode[1], DateHelper::convertMonthFromRusToInt($explode[0]));
            })
            ->values();

        foreach ($months as $month) {
            $properties = $this->transformer->fromJsonToProperties($month->properties);

            foreach ($properties as $property) {
                // мы берем только подсчитанные суммы у свойств rollup
                if ($property->getType() === PropertyTypeEnum::Rollup->value) {
                    $invoices[] = $this->invoiceMonthFactory->make(
                        $property->getName(),
                        $month->title,
                        (int)$property->getValue(),
                    );
                }
            }
        }

        return $invoices;
    }

}
