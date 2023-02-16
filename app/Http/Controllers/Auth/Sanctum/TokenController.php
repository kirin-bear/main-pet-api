<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Sanctum;

use App\Http\Controllers\Controller;
use App\Models\KirinBear\User;
use Illuminate\Hashing\HashManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TokenController extends Controller
{
    /**
     * Создание токена
     *
     * @param HashManager $hashManager
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function create(HashManager $hashManager, Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device' => 'required|string'
        ]);

        $user = User::whereEmail((string)$request->get('email'))->first();

        if (!$user || !$hashManager->check($request->get('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'token' => $user
                ->createToken($request->get('device'))
                ->plainTextToken
        ]);
    }
}
