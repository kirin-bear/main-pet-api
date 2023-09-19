<?php

declare(strict_types=1);

namespace App\Jobs\Contracts;

interface RabbitMqJobContract
{
    /**
     * @return object
     */
    public function getRabbitMqPayload(): object;

    /**
     * @return string
     */
    public function getRabbitMqMessageType(): string;
}
