<?php

declare(strict_types=1);

namespace App\UseCases\Notion;

use App\Domains\Notion\Exceptions\ApiServiceException;
use App\Domains\Notion\Services\Api;
use App\Models\KirinBear\NotionDatabase;
use App\Models\KirinBear\User;
use App\Repositories\KirinBear\NotionDatabaseRepository;
use Illuminate\Support\Carbon;
use JsonException;

class DatabasesSyncUseCase
{
    private Api $api;
    private NotionDatabaseRepository $notionDatabaseRepository;

    public function __construct(Api $api, NotionDatabaseRepository $notionDatabaseRepository)
    {
        $this->api = $api;
        $this->notionDatabaseRepository = $notionDatabaseRepository;
    }

    /**
     * @param string ...$uuids
     * @return bool
     *
     * @throws ApiServiceException|JsonException
     */
    public function execute(string ...$uuids): bool
    {

        $userId = User::MAIN_USER_ID;

        $inserts = [];

        foreach ($uuids as $uuid) {
            $database = $this->api->getDatabase($uuid);

            $notionDatabase = $this->notionDatabaseRepository->newModel();
            $notionDatabase->uuid = $database->getUuid();
            $notionDatabase->title = $database->getTitle();
            $notionDatabase->user_id = $userId;
            $notionDatabase->parent_uuid = $database->getParentObject()->getUuid();
            $notionDatabase->parent_type = $database->getParentObject()->getType();
            $notionDatabase->url = $database->getDescription()->getUrl();
            $notionDatabase->raw_data = json_encode($database->getDescription()->getRawData(), JSON_THROW_ON_ERROR);
            $notionDatabase->in_trash = $database->getDescription()->isInTrash();
            $notionDatabase->updated_at = new Carbon();

            $inserts[] = $notionDatabase->toArray();
        }

        if ($inserts) {
            $this->notionDatabaseRepository
                ->createQueryBuilder()
                ->upsert($inserts, [NotionDatabase::FIELD_NAME_UUID]);
        }

        return true;
    }

}
