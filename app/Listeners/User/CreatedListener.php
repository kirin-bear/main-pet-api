<?php

declare(strict_types=1);

namespace App\Listeners\User;

use App\Events\User\Created;
use App\Jobs\RabbitMqJob;
use Illuminate\Bus\Dispatcher;

class CreatedListener
{
    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Created $created
     * @return void
     */
    public function handle(Created $created): void
    {
        $this->dispatcher->dispatch(new RabbitMqJob([
            'id' => $created->getId(),
            'event' => 'user_created',
            'email' => $created->getEmail(),
        ]));
    }
}
