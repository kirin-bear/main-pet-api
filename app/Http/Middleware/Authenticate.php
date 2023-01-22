<?php

namespace App\Http\Middleware;

use App\Exceptions\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException('Unauthenticated', 401);
    }
}
