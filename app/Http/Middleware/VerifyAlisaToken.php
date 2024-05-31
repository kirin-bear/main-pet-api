<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class VerifyAlisaToken
{
    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     *
     * @throws AuthenticationException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $request->whenMissing('t', static function () {
            throw new AuthenticationException("Ошибка авторизации запроса от Алисы");
        });

        if ($request->get('t') !== config('alisa.token')) {
            throw new AuthenticationException("Некорректный токен в запросе от Алисы");
        }

        return $next($request);
    }

}
