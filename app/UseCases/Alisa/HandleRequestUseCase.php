<?php

declare(strict_types=1);

namespace App\UseCases\Alisa;

use App\Domains\Alisa\Dto\Request;
use App\Repositories\KirinBear\AlisaWebhookRepository;

class HandleRequestUseCase
{
    private AlisaWebhookRepository $alisaWebhookRepository;

    public function __construct(AlisaWebhookRepository $alisaWebhookRepository)
    {
        $this->alisaWebhookRepository = $alisaWebhookRepository;
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

        $response = [
            'response' => [
                'text' => 'Сохранила запрос под номером ' . $alisaWebhook->id,
                'tts' => 'Сохранила запрос под номером ' . $alisaWebhook->id,
            ]
        ];
        $alisaWebhook->response = json_encode($response, JSON_THROW_ON_ERROR);
        $alisaWebhook->save();

        return $response;
    }

}
