<?php

declare(strict_types=1);

namespace App\Domains\Alisa\Interfaces;

use App\Domains\Alisa\ValueObject\Request;

interface DoItForAlisaInterface
{
    public function doItForAlisaAndReply(Request $request): ?string;
}
