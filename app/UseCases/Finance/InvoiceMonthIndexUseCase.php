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
use App\Repositories\KirinBear\NotionPageRepository;
use Carbon\Carbon;

class InvoiceMonthIndexUseCase
{
    private InvoiceMonthFactory $invoiceMonthFactory;
    private NotionPageRepository $notionPageRepository;
    private Transformer $transformer;
    private PropertyTag $notionPropertyTag;

    public function __construct(
        InvoiceMonthFactory $invoiceMonthFactory,
        NotionPageRepository $notionPageRepository,
        Transformer $transformer,
        PropertyTag $notionPropertyTag
    ) {
        $this->invoiceMonthFactory = $invoiceMonthFactory;
        $this->notionPageRepository = $notionPageRepository;
        $this->transformer = $transformer;
        $this->notionPropertyTag = $notionPropertyTag;
    }

    /**
     * @param int $userId
     * @param string $type
     *
     * @return InvoiceMonth[]
     *
     * @throws \JsonException
     */
    public function execute(int $userId, string $type): array
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

        $propertiesIds = $this->notionPropertyTag->getPropertiesByDatabaseAndTag(PageUuidEnums::MonthReportUuid->value, $type);

        foreach ($months as $month) {
            $properties = $this->transformer->fromJsonToProperties($month->properties);
            foreach ($properties as $property) {

                // мы берем только подсчитанные суммы у свойств rollup
                if (in_array($property->getId(), $propertiesIds)) {
                    $invoices[] = $this->invoiceMonthFactory->make(
                        $property->getName(),
                        $month->title,
                        (int)$property->getValue(),
                        $type
                    );
                }
            }
        }

        return $invoices;
    }

}
