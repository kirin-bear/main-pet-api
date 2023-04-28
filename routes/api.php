<?php

use App\Http\Controllers\Api\V1\StorageController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\VisitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => '/v1'], function () {
    Route::post('/visit', [VisitController::class, 'store'])
        ->withoutMiddleware('auth:api');

    Route::get('/user/me', [UserController::class, 'me']);

    Route::post('/storage/upload', [StorageController::class, 'upload']);
});
