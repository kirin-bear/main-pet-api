<?php

declare(strict_types=1);

namespace App\Repositories\KirinBear;

use App\Models\KirinBear\AlisaWebhook;
use App\Repositories\AbstractModelRepository;

/**
 * @method AlisaWebhook newModel()
 */
class AlisaWebhookRepository extends AbstractModelRepository
{
    public function getClassName(): string
    {
        return AlisaWebhook::class;
    }
}
