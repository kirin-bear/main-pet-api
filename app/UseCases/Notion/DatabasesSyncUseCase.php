<?php

declare(strict_types=1);

namespace App\UseCases\Notion;

use App\Domains\Alisa\Enums\UserEnums;
use App\Domains\Alisa\Interfaces\DoItForAlisaInterface;
use App\Domains\Alisa\ValueObject\Request;
use App\Domains\Notion\Exceptions\ApiServiceException;
use App\Domains\Notion\Services\Api;
use App\Models\KirinBear\NotionDatabase;
use App\Models\KirinBear\NotionPage;
use App\Models\KirinBear\User;
use App\Repositories\KirinBear\NotionDatabaseRepository;
use App\Repositories\KirinBear\NotionPageRepository;
use Illuminate\Support\Carbon;
use JsonException;

class DatabasesSyncUseCase implements DoItForAlisaInterface
{
    private Api $api;
    private NotionDatabaseRepository $notionDatabaseRepository;
    private NotionPageRepository $notionPageRepository;

    public function __construct(
        Api $api,
        NotionDatabaseRepository $notionDatabaseRepository,
        NotionPageRepository $notionPageRepository
    )
    {
        $this->api = $api;
        $this->notionDatabaseRepository = $notionDatabaseRepository;
        $this->notionPageRepository = $notionPageRepository;
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

        $uuidsDatabases = [];
        $insertDatabases = [];
        $insertPages = [];

        foreach ($uuids as $uuid) {
            $database = $this->api->getDatabase($uuid);

            $modelDatabase = $this->notionDatabaseRepository->newModel();
            $modelDatabase->uuid = $database->getUuid();
            $modelDatabase->title = $database->getTitle();
            $modelDatabase->user_id = $userId;
            $modelDatabase->parent_uuid = $database->getParentObject()->getUuid();
            $modelDatabase->parent_type = $database->getParentObject()->getType();
            $modelDatabase->url = $database->getDescription()->getUrl();
            $modelDatabase->raw_data = json_encode($database->getDescription()->getRawData(), JSON_THROW_ON_ERROR);
            $modelDatabase->in_trash = $database->getDescription()->isInTrash();
            $modelDatabase->updated_at = new Carbon();

            $insertDatabases[] = $modelDatabase->toArray();
            $uuidsDatabases[] = $database->getUuid();
        }

        // вставляем
        if ($insertDatabases) {
            $this->notionDatabaseRepository
                ->createQueryBuilder()
                ->upsert($insertDatabases, [NotionDatabase::FIELD_NAME_UUID]);
        }

        // теперь просинхроним все страницы баз данных
        foreach ($uuidsDatabases as $uuid) {
            $pages = $this->api->getPagesByDatabaseUuid($uuid);

            foreach ($pages as $page) {
                $modelPage = $this->notionPageRepository->newModel();
                $modelPage->uuid = $page->getUuid();
                $modelPage->title = $page->getTitle();
                $modelPage->user_id = $userId;
                $modelPage->parent_uuid = $page->getParentObject()->getUuid();
                $modelPage->parent_type = $page->getParentObject()->getType();
                $modelPage->properties = json_encode($page->getProperties(), JSON_THROW_ON_ERROR);
                $modelPage->url = $page->getDescription()->getUrl();
                $modelPage->raw_data = json_encode($page->getDescription()->getRawData(), JSON_THROW_ON_ERROR);
                $modelPage->in_trash = $page->getDescription()->isInTrash();
                $modelPage->updated_at = new Carbon();

                $insertPages[] = $modelPage->toArray();
            }
        }

        // вставляем страницы
        if ($insertPages) {
            $this->notionPageRepository
                ->createQueryBuilder()
                ->upsert($insertPages, [NotionPage::FIELD_NAME_UUID]);
        }


        return true;
    }

    /**
     * @param Request $request
     * @return string|null
     * @throws ApiServiceException
     *
     * @throws JsonException
     */
    public function doItForAlisaAndReply(Request $request): ?string
    {
        if ($request->getUserId() !== UserEnums::Me->value) {
            return null;
        }
        $databases = config('notion.sync_databases');
        $this->execute(... $databases);
        return 'Отправлена команда на синхронизацию финансов';
    }
}
