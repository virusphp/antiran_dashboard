<?php

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
Route::get('/', function () {
    return redirect('/admin/home');
});

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/admin/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/admin/login', 'LoginController@login');
    Route::post('/admin/logout', 'LoginController@logout')->name('logout');
});

Route::group(['namespace' => 'Backend', 'prefix' => 'admin'], function() {
    Route::get('/home', 'HomeController@index')->name('home');

    // Master
    Route::resource('/pegawai', 'PegawaiController');
    Route::resource('/pekerjaan', 'PekerjaanController');

    // CLient
    Route::resource('/client', 'ClientController');
    Route::get('/ajax/client', 'ClientController@indexAjax');
    Route::delete('/ajax/client/destroy', 'ClientController@ajaxDestroy');

    //divisi
    Route::resource('/divisi', 'DivisiController');
    Route::get('/ajax/divisi', 'DivisiController@indexAjax');
});
