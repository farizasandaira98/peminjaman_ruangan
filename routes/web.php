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

        Route::get('/inventaris/{id}', [App\Http\Controllers\DataInventarisController::class, 'index'])->name('datainventaris.index');
        Route::get('/inventaris/{id}/create', [App\Http\Controllers\DataInventarisController::class, 'create'])->name('datainventaris.create');
        Route::post('/inventaris/{id}/store', [App\Http\Controllers\DataInventarisController::class, 'store'])->name('datainventaris.store');
        Route::get('/inventaris/{id}/edit/{idinventaris}', [App\Http\Controllers\DataInventarisController::class, 'edit'])->name('datainventaris.edit');
        Route::post('/inventaris/{id}/update/{idinventaris}', [App\Http\Controllers\DataInventarisController::class, 'update'])->name('datainventaris.update');
        Route::get('/inventaris/{id}/destroy/{idinventaris}', [App\Http\Controllers\DataInventarisController::class, 'destroy'])->name('datainventaris.destroy');

    });

    Route::prefix('datapeminjaman')->group(function() {
        Route::get('/', [App\Http\Controllers\DataPeminjamanController::class, 'index'])->name('datapeminjaman.index');
        Route::get('/create/{id}', [App\Http\Controllers\DataPeminjamanController::class, 'create'])->name('datapeminjaman.createuser');
        Route::get('/create', [App\Http\Controllers\DataPeminjamanController::class, 'createadmin'])->name('datapeminjaman.create');
        Route::post('/store', [App\Http\Controllers\DataPeminjamanController::class, 'store'])->name('datapeminjaman.store');
        Route::get('/destroy/{id}', [App\Http\Controllers\DataPeminjamanController::class, 'destroy'])->name('datapeminjaman.destroy');
    });

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});
