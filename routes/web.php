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

use App\Http\Controllers\Backend\ClientController;

Route::get('/', function () {
    return redirect('/admin/home');
});

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/admin/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/admin/login', 'LoginController@login');
    Route::post('/admin/logout', 'LoginController@logout')->name('logout');
});

Route::group(['middleware' => ['auth'], 'namespace' => 'Backend', 'prefix' => 'admin'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Master
    //pegawai
    Route::resource('/pegawai', 'PegawaiController');
    Route::resource('/proses', 'ProsesPekerjaanController');
    Route::get('/ajax/proses', 'ProsesPekerjaanController@indexAjax');
    Route::get('/ajax/pegawai', 'PegawaiController@indexAjax');
    Route::delete('/ajax/pegawai/destroy', 'PegawaiController@ajaxDestroy');

    Route::resource('/pekerjaan', 'PekerjaanController');
    Route::get('/ajax/pekerjaan', 'PekerjaanController@indexAjax');
    Route::delete('/ajax/pekerjaan/destroy', 'PekerjaanController@ajaxDestroy');

    // Proses Pekerjaan
    Route::resource('/proses', 'ProsesPekerjaanController');
    Route::get('/ajax/proses', 'ProsesPekerjaanController@indexAjax');
    Route::delete('/ajax/proses/destroy', 'ProsesPekerjaanController@ajaxDestroy');

    // CLient
    Route::resource('/client', 'ClientController');
    Route::get('/ajax/client', 'ClientController@indexAjax');
    Route::delete('/ajax/client/destroy', 'ClientController@ajaxDestroy');

    //divisi
    Route::resource('/divisi', 'DivisiController');
    Route::get('/ajax/divisi', 'DivisiController@indexAjax');
    Route::delete('/ajax/divisi/destroy', 'DivisiController@ajaxDestroy');

    //user
    Route::resource('/users', 'UserController');
    Route::get('/ajax/users', 'UserController@indexAjax');
    Route::delete('/ajax/users/destroy', 'UserController@ajaxDestroy');

    //role
    Route::resource('/roles', 'RoleController');
    Route::get('/ajax/roles', 'RoleController@indexAjax');
    Route::get('roles/check/{id}', 'RoleController@check')->name('roles.check');
    Route::delete('/ajax/roles/destroy', 'RoleController@ajaxDestroy');

    //transaksi
    //registrasi
    Route::resource('/registrasi','RegistrasiController');
    Route::get('/ajax/registrasi/pekerjaan/cari','RegistrasiController@cariPekerjaan')->name('registrasi.cari.pekerjaan');
});
