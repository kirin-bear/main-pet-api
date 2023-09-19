<?php

declare(strict_types=1);

namespace App\Queues;

use App\Jobs\Contracts\RabbitMqJobContract;
use Exception;
use Illuminate\Support\Str;

class RabbitMqQueue extends \VladimirYuldashev\LaravelQueueRabbitMQ\Queue\RabbitMQQueue
{
    /**
     * Определяем свою структуру payload для отправки в rabbit
     *
     * @param object $job
     * @param string $queue
     * @param mixed $data
     *
     * @return array
     * @throws Exception
     */
    protected function createPayloadArray($job, $queue, $data = ''): array
    {
        if (!$job instanceof RabbitMqJobContract) {
            throw new Exception("Jon is not supported interface for RabbitMq");
        }

        return [
            'uuid' => Str::uuid(),
            'type' => $job->getRabbitMqMessageType(),
            'data' => $job->getRabbitMqPayload(),
        ];
    }

}
