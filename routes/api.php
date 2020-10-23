<?php

use Illuminate\Http\Request;

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

Route::group(['namespace' => 'Api'], function() {

    Route::post('/access/register', 'RegistrasiPlatformController@register')->name('register.acceess');
    Route::post('/access/login', 'LoginPlatformController@login')->name('login.acceess');

    Route::group(['middleware' => ['signature:api']], function (){
        // get and list divisi
        Route::get('/divisi/getlist', 'DivisiController@getList');

        // get and list pegawai
        Route::get('/pegawai/getlist', 'PegawaiController@getList');
    });
});