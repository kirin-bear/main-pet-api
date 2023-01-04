<?php

declare(strict_types=1);

namespace App\UseCase\Session;

use App\Repositories\KirinBear\SessionRepository;
use Jenssegers\Agent\Agent;

class SessionStoreUseCase
{
    private Agent $agent;
    private SessionRepository $sessionRepository;

    public function __construct(Agent $agent, SessionRepository $sessionRepository)
    {
        $this->agent = $agent;
        $this->sessionRepository = $sessionRepository;
    }

    public function execute(): int
    {
        $session = $this->sessionRepository->getEntity();
        return 1;
    }

}
