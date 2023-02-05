<?php

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::prefix('dataruangan')->group(function() {
        Route::get('/', [App\Http\Controllers\DataRuanganController::class, 'index'])->name('dataruangan.index');
        Route::get('/create', [App\Http\Controllers\DataRuanganController::class, 'create'])->name('dataruangan.create');
        Route::post('/store', [App\Http\Controllers\DataRuanganController::class, 'store'])->name('dataruangan.store');
        Route::get('/edit/{id}', [App\Http\Controllers\DataRuanganController::class, 'edit'])->name('dataruangan.edit');
        Route::post('/update/{id}', [App\Http\Controllers\DataRuanganController::class, 'update'])->name('dataruangan.update');
        Route::get('/destroy/{id}', [App\Http\Controllers\DataRuanganController::class, 'destroy'])->name('dataruangan.destroy');
    });

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});
