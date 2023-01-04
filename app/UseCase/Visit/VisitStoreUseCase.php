<?php

declare(strict_types=1);

namespace App\UseCase\Visit;

use App\Repositories\KirinBear\VisitRepository;
use Illuminate\Support\Carbon;
use Jenssegers\Agent\Agent;

class VisitStoreUseCase
{
    private Agent $agent;
    private VisitRepository $sessionRepository;

    public function __construct(Agent $agent, VisitRepository $sessionRepository)
    {
        $this->agent = $agent;
        $this->sessionRepository = $sessionRepository;
    }

    /**
     * @param string $page
     * @param string $referer
     *
     * @return int
     */
    public function execute(string $page, string $referer): int
    {
        $session = $this->sessionRepository->getEntity();
        $session->page = $page;
        $session->referer = $referer;
        $session->device = $this->agent->deviceType();
        $session->device_name = $this->agent->device() ?: '';

        $session->platform = $this->agent->platform() ?: '';
        $session->platform_version = $this->agent->version($session->platform) ?: '';

        $session->browser = $this->agent->browser() ?: '';
        $session->browser_version = $this->agent->version($session->browser) ?: '';

        $session->robot = $this->agent->robot() ?: '';
        $session->created_at = new Carbon();

        $session->user_agent = $this->agent->getUserAgent() ?: '';

        $this->sessionRepository->add($session);

        return $session->id;
    }

}
