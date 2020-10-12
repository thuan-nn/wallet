<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryWalletController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WalletController;
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

Route::post('registry', [UserController::class, 'registry']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['api'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
    Route::resource('category-wallet', CategoryWalletController::class);
    Route::resource('wallets', WalletController::class);
});
