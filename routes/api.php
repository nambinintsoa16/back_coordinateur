<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChiffreAffaireController;
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


Route::controller(UserController::class)->group(function () {
    Route::get('users', 'getUsers')->name('users');

    Route::prefix('user')->group(function () {
        Route::get('', 'getUser')->name('user');
    });

});

Route::middleware('api')->prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout');
    });
});


Route::middleware('api')->prefix('chiffreAffaire')->group(function () {
    Route::controller(ChiffreAffaireController::class)->group(function () {
        Route::get('', 'getChiffreAffaire')->name('chiffre_affaire');
    });
});


