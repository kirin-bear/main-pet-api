<?php

declare(strict_types=1);

namespace App\UseCase\Visit;

use App\Models\KirinBear\Visit;
use Illuminate\Support\Carbon;
use Jenssegers\Agent\Agent;

class VisitStoreUseCase
{
    private Agent $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    /**
     * @param string $page
     * @param string $referer
     * @param string $ipAddress
     *
     * @return int
     */
    public function execute(string $page, string $referer, string $ipAddress): int
    {
        $session = new Visit();
        $session->page = $page;
        $session->referer = $referer;
        $session->ip_address = $ipAddress;
        $session->device = $this->agent->deviceType();
        $session->device_name = $this->agent->device() ?: '';

        $session->platform = $this->agent->platform() ?: '';
        $session->platform_version = $this->agent->version($session->platform) ?: '';

        $session->browser = $this->agent->browser() ?: '';
        $session->browser_version = $this->agent->version($session->browser) ?: '';

        $session->robot = $this->agent->robot() ?: '';
        $session->created_at = new Carbon();

        $session->user_agent = $this->agent->getUserAgent() ?: '';

        $session->save();

        return $session->id;
    }

}
