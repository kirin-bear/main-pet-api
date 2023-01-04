<?php

declare(strict_types=1);

namespace App\Models\KirinBear;

use App\Models\AbstractModel;

class Session extends AbstractModel
{
    protected $connection = 'mysql';

    protected $table = 'sessions';

    public const UPDATED_AT = false;
}
