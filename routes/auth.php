<?php

use App\Http\Controllers\Auth\Sanctum\TokenController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/sanctum'], function () {
    Route::post('/token', [TokenController::class, 'create']);
});
