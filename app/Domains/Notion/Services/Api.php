<?php

declare(strict_types=1);

namespace App\Domains\Notion\Services;

use App\Domains\Notion\Constants\ApiConstants;
use App\Domains\Notion\Entities\Database;
use App\Domains\Notion\Entities\Page;
use App\Domains\Notion\Entities\ParentObject;
use App\Domains\Notion\Enums\ParentObjectTypeEnum;
use App\Domains\Notion\Exceptions\ApiServiceException;
use App\Domains\Notion\ValueObject\DatabaseDescription;
use App\Domains\Notion\ValueObject\PageDescription;
use FiveamCode\LaravelNotionApi\Entities\Page as NotionPage;
use FiveamCode\LaravelNotionApi\Exceptions\HandlingException;
use FiveamCode\LaravelNotionApi\Exceptions\LaravelNotionAPIException;
use FiveamCode\LaravelNotionApi\Exceptions\NotionException;
use FiveamCode\LaravelNotionApi\Notion;

class Api
{
    private Notion $notionApi;
    public function __construct(Notion $notion)
    {
        $this->notionApi = $notion;
    }

    /**
     * @param string $uuid
     * @return Database
     *
     * @throws ApiServiceException
     */
    public function getDatabase(string $uuid): Database
    {
        try {
            $database = $this->notionApi->databases()->find($uuid);
        } catch (HandlingException|NotionException $exception) {
            throw new ApiServiceException($exception->getMessage(), $exception->getCode());
        }

        return new Database(
            $database->getId(),
            $database->getTitle(),
            new ParentObject(
                $database->getParentId(),
                ParentObjectTypeEnum::from($database->getParentType())
            ),
            new DatabaseDescription(
                $database->getUrl(),
                $database->getRawResponse()[ApiConstants::FIELD_NAME_IN_TRASH] ?? false,
                $database->getRawResponse()
            ),
        );
    }

    /**
     * @param string $uuid
     * @return Page[]
     *
     * @throws ApiServiceException
     */
    public function getPagesByDatabaseUuid(string $uuid): array
    {
        $pages = [];

        try {
            /** @var NotionPage[] $pagesFromApi */
            $pagesFromApi = $this->notionApi->database($uuid)
                ->query()
                ->asCollection();
        } catch (HandlingException|NotionException|LaravelNotionAPIException $exception) {
            throw new ApiServiceException($exception->getMessage(), $exception->getCode());
        }

        foreach ($pagesFromApi as $pageFromApi) {
            $pages[] = new Page(
                $pageFromApi->getId(),
                $pageFromApi->getTitle(),
                $pageFromApi->getRawProperties(),
                new ParentObject(
                    $pageFromApi->getParentId(),
                    ParentObjectTypeEnum::from($pageFromApi->getParentType())
                ),
                new PageDescription(
                    $pageFromApi->getUrl(),
                    $pageFromApi->getRawResponse()[ApiConstants::FIELD_NAME_IN_TRASH] ?? false,
                    $pageFromApi->getRawResponse()
                )
            );
        }

        return $pages;
    }

}
