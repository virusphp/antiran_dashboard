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
    Route::resource('/registrasi', 'RegistrasiController');
    Route::get('/ajax/registrasi', 'RegistrasiController@indexAjax');
    Route::post('/ajax/registrasi/modalsep', 'RegistrasiController@ajaxModalSep');

    //  LIST DROPDOWN
    Route::get('/ajax/list/kelas', 'KelasRawatController@ajaxListKelas');
    Route::get('/ajax/list/carabayar', 'CarabayarController@ajaxListCarabayar');
    Route::get('/ajax/list/asalpasien', 'AsalpasienController@ajaxListAsalpasien');
    Route::get('/ajax/list/instansi', 'InstansiController@ajaxListInstansi');

    Route::group(['namespace' => 'BridgingBPJS'], function() {
        // GET PESERTA BPJS
        Route::post('/ajax/bpjs/peserta', 'PesertaController@ajaxPesertaBpjs');
        Route::post('/ajax/bpjs/listrujukan', 'RujukanController@ajaxListRujukanBpjs');
        Route::post('/ajax/bpjs/rujukan', 'RujukanController@ajaxRujukanBpjs');
        Route::post('/ajax/bpjs/insertsep', 'SepController@ajaxInsertSepBpjs');
    });
    
    // Master
    Route::group(['namespace' => 'Master'], function() {
        Route::resource('/pasien', 'PasienController');
        Route::get('/ajax/pasien', 'PasienController@indexAjax');
    });

    Route::group(['namespace' => 'Transaksi'], function() {
        Route::resource('/antrian', 'AntrianController');
        Route::get('/antrian/poli/{poli}/tanggal/{tanggal}', 'AntrianController@showPoli')->name('antrian.showpoli');
        Route::get('/ajax/antrian', 'AntrianController@indexAjax');

    });

     //user
    Route::resource('/users', 'UserController');
    Route::get('/ajax/users', 'UserController@indexAjax');
    Route::delete('/ajax/users/destroy', 'UserController@ajaxDestroy');

    //role
    Route::resource('/roles', 'RoleController');
    Route::get('/ajax/roles', 'RoleController@indexAjax');
    Route::get('roles/check/{id}', 'RoleController@check')->name('roles.check');
    Route::delete('/ajax/roles/destroy', 'RoleController@ajaxDestroy');
  
});
