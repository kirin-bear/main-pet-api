<?php

declare(strict_types=1);

namespace App\Listeners\Visit;

use App\Enums\Connections;
use App\Events\Visit\Created;
use App\Jobs\VisitCreatedJob;

class CreatedListener
{
    /**
     * Handle the event.
     *
     * @param Created $visitCreated
     * @return void
     */
    public function handle(Created $visitCreated): void
    {
        dispatch(new VisitCreatedJob($visitCreated->getId()))->onConnection(Connections::RABBITMQ);
    }
}
