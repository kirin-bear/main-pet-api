<?php

use Illuminate\Support\Facades\Route;

/** Экпериментальное решение для быстрого старта */
Route::group(['prefix' => '/sanctum'], function () {
    Route::post('/token', [\App\Http\Controllers\Auth\Sanctum\TokenController::class, 'create']);
});

/** Основная логика авторизации */
Route::group(['prefix' => '/jwt'], function () {

    Route::post('login', [\App\Http\Controllers\Auth\Jwt\AuthController::class, 'login']);

    Route::post('logout', [\App\Http\Controllers\Auth\Jwt\AuthController::class, 'logout'])
        ->middleware(['auth:api']);
    Route::post('refresh', [\App\Http\Controllers\Auth\Jwt\AuthController::class, 'refresh'])
        ->middleware(['auth:api']);
});
