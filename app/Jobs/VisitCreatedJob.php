<?php

namespace App\Jobs;

use App\Jobs\Contracts\RabbitMqJobContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use JetBrains\PhpStorm\NoReturn;

class VisitCreatedJob implements ShouldQueue, RabbitMqJobContract
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $id;

    /**
     * Create a new job instance.
     *
     * @param int $id
     */
    #[NoReturn] public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return object
     */
    public function getRabbitMqPayload(): object
    {
        return (object)[
            'id' => $this->id,
        ];
    }

    /**
     * @return string
     */
    public function getRabbitMqMessageType(): string
    {
        return 'visit_created';
    }
}
