<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Enums\Connections;
use App\Jobs\Contracts\RabbitMqJobContract;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RabbitMqJob implements ShouldQueue, RabbitMqJobContract
{
    public string $connection = Connections::RABBITMQ;

    use Dispatchable, InteractsWithQueue, SerializesModels;

    private array $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function getRabbitMqPayload(): object
    {
        return (object)$this->payload;
    }

    public function getRabbitMqMessageType(): string
    {
        return 'rabbitmq';
    }
}
