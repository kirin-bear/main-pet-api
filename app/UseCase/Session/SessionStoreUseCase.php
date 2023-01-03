<?php

declare(strict_types=1);

namespace App\UseCase\Session;

use Jenssegers\Agent\Agent;

class SessionStoreUseCase
{
    private Agent $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    public function execute(): int
    {
        return 1;
    }

}
