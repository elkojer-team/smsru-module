<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\SMSRU\App\Http\Controllers\SMSRUController;

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

Route::middleware(['throttle:2,1'])->prefix('v1/sms')->name('api.')->group(function () {
//    Route::resource('smsru', SMSRUController::class)->names('smsru');
    Route::post('send', [SMSRUController::class, 'index']);
});
