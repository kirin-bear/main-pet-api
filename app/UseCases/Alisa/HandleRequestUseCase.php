<?php

declare(strict_types=1);

namespace App\UseCases\Alisa;

use App\Domains\Alisa\Dto\Request;
use App\Domains\Alisa\Dto\Response;
use App\Domains\Alisa\Enums\UserEnums;
use App\Repositories\KirinBear\AlisaWebhookRepository;
use App\UseCases\Notion\DatabasesSyncUseCase;

class HandleRequestUseCase
{
    private AlisaWebhookRepository $alisaWebhookRepository;
    private DatabasesSyncUseCase $databasesSyncUseCase;

    public function __construct(AlisaWebhookRepository $alisaWebhookRepository, DatabasesSyncUseCase $databasesSyncUseCase)
    {
        $this->alisaWebhookRepository = $alisaWebhookRepository;
        $this->databasesSyncUseCase = $databasesSyncUseCase;
    }

    public function execute(array $params): array
    {

        $request = Request::fromArray($params);

        $alisaWebhook = $this->alisaWebhookRepository->newModel();
        $alisaWebhook->session_id = $request->getSessionId();
        $alisaWebhook->application_id = $request->getApplicationId();
        $alisaWebhook->user_id = $request->getUserId();
        $alisaWebhook->skill_id = $request->getSkillId();
        $alisaWebhook->request = json_encode($request->getParams(), JSON_THROW_ON_ERROR);
        $alisaWebhook->save();

        $text = 'Не понимаю вас, отстаньте';
        if ($request->getUserId() === UserEnums::Me->value && $request->getCommand() === 'синхронизируй мои финансы') {
            $databases = config('notion.sync_databases');
            $this->databasesSyncUseCase->execute(... $databases);
            $text = 'Финансы синхронизированы';
        }

        $responseArray = (new Response($text))->toArray();

        $alisaWebhook->response = json_encode($responseArray, JSON_THROW_ON_ERROR);
        $alisaWebhook->save();

        return $responseArray;
    }

}
