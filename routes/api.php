<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\KhojTheSearch\KhojTheSearchController;
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
Route::group(['middleware' => ['cors', 'json.response'],'prefix' => 'v1'], function () {
    Route::post('/user/sign-up', [RegisterController::class, 'signUp'])->name('api.auth.user.sign_up');
    Route::post('/user/sign-in', [LoginController::class, 'signIn'])->name('api.auth.user.sign_in');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/user/khoj-the-search/get-all-input-values', [KhojTheSearchController::class, 'getAllInputValues'])
            ->name('api.khoj_the_search.getAllInputValues');
        Route::get('/user/sign-out', [LoginController::class, 'signOut'])->name('api.auth.sign_out');
    });
});
