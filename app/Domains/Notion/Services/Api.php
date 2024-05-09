<?php

declare(strict_types=1);

namespace App\Domains\Notion\Services;

use App\Domains\Notion\Constants\ApiConstants;
use App\Domains\Notion\Entities\Database;
use App\Domains\Notion\Entities\ParentObject;
use App\Domains\Notion\Enums\ParentObjectTypeEnum;
use App\Domains\Notion\Exceptions\ApiServiceException;
use App\Domains\Notion\ValueObject\DatabaseDescription;
use FiveamCode\LaravelNotionApi\Exceptions\HandlingException;
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

}
