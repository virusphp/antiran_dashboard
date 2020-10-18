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

Route::group(['middleware' => ['auth'], 'namespace' => 'Backend', 'prefix' => 'admin'], function() {
    Route::get('/home', 'HomeController@index')->name('home');

    // Master
    //pegawai
    Route::resource('/pegawai', 'PegawaiController');
    Route::get('/ajax/pegawai', 'PegawaiController@indexAjax');
    Route::delete('/ajax/pegawai/destroy', 'PegawaiController@ajaxDestroy');

    Route::resource('/pekerjaan', 'PekerjaanController');
    Route::get('/ajax/pekerjaan', 'PekerjaanController@indexAjax');
    Route::delete('/ajax/pekerjaan/destroy', 'PekerjaanController@ajaxDestroy');

    // CLient
    Route::resource('/client', 'ClientController');
    Route::get('/ajax/client', 'ClientController@indexAjax');
    Route::delete('/ajax/client/destroy', 'ClientController@ajaxDestroy');

    //divisi
    Route::resource('/divisi', 'DivisiController');
    Route::get('/ajax/divisi', 'DivisiController@indexAjax');
    Route::delete('/ajax/divisi/destroy', 'DivisiController@ajaxDestroy');
});
