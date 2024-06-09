<?php

declare(strict_types=1);

namespace App\UseCases\Alisa;

use App\Domains\Alisa\Dto\Response;
use App\Domains\Alisa\Services\Replier;
use App\Domains\Alisa\ValueObject\Request;
use App\Repositories\KirinBear\AlisaWebhookRepository;

class HandleRequestUseCase
{
    private AlisaWebhookRepository $alisaWebhookRepository;
    private Replier $replier;

    public function __construct(
        AlisaWebhookRepository $alisaWebhookRepository,
        Replier $replier
    ) {
        $this->alisaWebhookRepository = $alisaWebhookRepository;
        $this->replier = $replier;
    }

    public function execute(array $params): array
    {

        $request = Request::fromArray($params);

        $alisaWebhook = $this->alisaWebhookRepository->newModel();
        $alisaWebhook->session_id = $request->getSession()->getId();
        $alisaWebhook->application_id = $request->getApplicationId();
        $alisaWebhook->user_id = $request->getUserId();
        $alisaWebhook->skill_id = $request->getSkillId();
        $alisaWebhook->request = json_encode($request->getParams(), JSON_THROW_ON_ERROR);
        $alisaWebhook->save();

        if ($request->getSession()->isNew()) {
            $text = $this->replier->hello();
        } else {
            $text = $this->replier->doAndReply($request);
        }

        $responseArray = (new Response($text))->toArray();

        $alisaWebhook->response = json_encode($responseArray, JSON_THROW_ON_ERROR);
        $alisaWebhook->save();

        return $responseArray;
    }

}
