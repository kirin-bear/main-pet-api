<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/alisa', 'middleware' => [\App\Http\Middleware\VerifyAlisaToken::class]], static function () {
    Route::post('/request', [\App\Http\Controllers\Webhooks\Alisa\RequestController::class, 'store']);
});
