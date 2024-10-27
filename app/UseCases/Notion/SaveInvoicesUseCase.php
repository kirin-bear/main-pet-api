<?php

declare(strict_types=1);

namespace App\UseCases\Notion;

use App\Domains\Finance\Enums\InvoiceTypeEnum;
use App\Domains\Notion\Enums\PageUuidEnums;
use App\Domains\Notion\Services\PropertyTag;
use App\Domains\Notion\Services\Transformer;
use App\Helpers\DateHelper;
use App\Models\KirinBear\NotionPage;
use App\Repositories\KirinBear\FinanceInvoiceRepository;
use App\Repositories\KirinBear\NotionPageRepository;
use Carbon\Carbon;

class SaveInvoicesUseCase
{
    private FinanceInvoiceRepository $financeInvoiceRepository;
    private NotionPageRepository $notionPageRepository;
    private Transformer $transformer;
    private PropertyTag $notionPropertyTag;

    public function __construct(
        NotionPageRepository $notionPageRepository,
        Transformer $transformer,
        PropertyTag $notionPropertyTag,
        FinanceInvoiceRepository $financeInvoiceRepository
    ) {
        $this->notionPageRepository = $notionPageRepository;
        $this->transformer = $transformer;
        $this->notionPropertyTag = $notionPropertyTag;
        $this->financeInvoiceRepository = $financeInvoiceRepository;
    }

    public function execute(int $userId): void
    {
        $types = InvoiceTypeEnum::cases();

        $months = $this->notionPageRepository
            ->getByUserAndParentUuid($userId, PageUuidEnums::MonthReportUuid->value)
            ->sortBy(function (NotionPage $notionPage) {
                // сортируем относительно названия
                $explode = explode(' ', $notionPage->title);
                return Carbon::createFromDate($explode[1], DateHelper::convertMonthFromRusToInt($explode[0]));
            })
            ->values();

        foreach ($types as $type) {

            $propertiesIds = $this->notionPropertyTag->getPropertiesByDatabaseAndTag(PageUuidEnums::MonthReportUuid->value, $type->value);

            foreach ($months as $month) {
                $properties = $this->transformer->fromJsonToProperties($month->properties);
                foreach ($properties as $property) {

                    // мы берем только подсчитанные суммы у свойств rollup
                    if (in_array($property->getId(), $propertiesIds)) {

                        $invoice = $this->financeInvoiceRepository->newModel();

                        $explode = explode(' ', $month->title);
                        $date = Carbon::createFromDate($explode[1], DateHelper::convertMonthFromRusToInt($explode[0]));

                        $invoice->name = $property->getName();
                        $invoice->type = $type->value;
                        $invoice->from = $date->startOfMonth();
                        $invoice->till = $date->copy()->endOfMonth();
                        $invoice->total = (int)$property->getValue();
                        $invoice->user_id = $month->user_id;
                        $invoice->hash = hash('sha256', implode(',', [
                            $invoice->name,
                            $invoice->type,
                            $invoice->from,
                            $invoice->till,
                            $invoice->user_id
                        ]));

                        $this->financeInvoiceRepository->createQueryBuilder()->upsert([$invoice->toArray()], ['user_id', 'hash']);
                    }
                }
            }
        }

    }

}
