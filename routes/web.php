<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\KhojTheSearch\KhojTheSearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'web'], function () {
    Route::get('/', [LoginController::class, 'index'])->name('web.auth.sign_in.index');

    Route::get('sign-up', [RegisterController::class, 'index'])->name('web.auth.sign_up.index');
    Route::post('sign-up-process', [RegisterController::class, 'signUp'])->name('web.auth.sign_up');

    Route::get('/sign-in', [LoginController::class, 'index'])->name('web.auth.sign_in.index');
    Route::post('/sign-in-process', [LoginController::class, 'signIn'])->name('web.auth.sign_in');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/sign-out', [LoginController::class, 'signOut'])->name('web.auth.sign_out');
        Route::get('/khoj-the-search', [KhojTheSearchController::class, 'index'])->name('web.khoj_the_search.index');
        Route::post('/khoj-the-search', [KhojTheSearchController::class, 'store'])->name('web.khoj_the_search.store');
    });

});


