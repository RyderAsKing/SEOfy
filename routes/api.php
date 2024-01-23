<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WHMCSController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('whmcs.')
    ->prefix('whmcs')
    ->middleware('app.api_key')
    ->group(function () {
        Route::get('check-account', [
            WHMCSController::class,
            'CheckAccount',
        ])->name('check-account');

        Route::post('create-account', [
            WHMCSController::class,
            'CreateAccount',
        ])->name('create-account');

        Route::patch('suspend-account', [
            WHMCSController::class,
            'SuspendAccount',
        ])->name('suspend-account');

        Route::patch('unsuspend-account', [
            WHMCSController::class,
            'UnsuspendAccount',
        ])->name('unsuspend-account');

        Route::delete('terminate-account', [
            WHMCSController::class,
            'TerminateAccount',
        ])->name('terminate-account');

        Route::patch('change-password', [
            WHMCSController::class,
            'ChangePassword',
        ])->name('change-password');

        Route::get('sso', [WHMCSController::class, 'SSO'])->name('sso');
        Route::patch('renew', [WHMCSController::class, 'renew'])->name('renew');
    });
