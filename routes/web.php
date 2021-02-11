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
    Route::get('/rujukan', 'RujukanController@index')->name('rujukan.index');
    Route::get('/ajax/rujukan/edit', 'RujukanController@ajaxEditRujukan')->name('rujukan.edit');
    Route::get('/ajax/rujukan', 'RujukanController@indexAjax');
    Route::get('/ajax/registrasi', 'RegistrasiController@indexAjax');
    Route::post('/ajax/registrasi/modalsep', 'RegistrasiController@ajaxModalSep');
    Route::post('/ajax/registrasi/edit/modalsep', 'RegistrasiController@ajaxEditModalSep');


    Route::post('/ajax/sep/editsep', 'SepController@ajaxEditSep');

    Route::get('/sep/print/{noreg}', 'SepController@printSep');
    Route::get('/rujukan/print/{norujukan}', 'RujukanController@printRujukan');

    // GET RUJUKAN INTERNAL
    Route::get('/ajax/rujukaninternal', 'RujukanController@ajaxRujukanInternal');

    // GET LIST NO SURAT SKDP
    Route::post('/ajax/list/skdp', 'SkdpController@ajaxListSkdp');

    // GET LIST PEGAWAI
    Route::get('ajax/list/pegawai', 'PegawaiController@ajaxListPegawai');

    //  LIST DROPDOWN
    Route::get('/ajax/list/kelas', 'KelasRawatController@ajaxListKelas');
    Route::get('/ajax/list/carabayar', 'CarabayarController@ajaxListCarabayar');
    Route::get('/ajax/list/asalpasien', 'AsalPasienController@ajaxListAsalpasien');
    Route::get('/ajax/list/instansi', 'InstansiController@ajaxListInstansi');
    Route::get('/ajax/list/propinsi', 'PropinsiController@ajaxListPropinsi');
    Route::post('/ajax/list/kabupaten', 'KabupatenController@ajaxListKabupaten');
    Route::post('/ajax/list/kecamatan', 'KecamatanController@ajaxListKecamatan');

    Route::group(['namespace' => 'BridgingBPJS'], function() {
        // GeT HISTORY PESERTA
        Route::post('/ajax/bpjs/history/peserta', 'MonitoringController@ajaxHistoryPeserta');
        // GET PESERTA BPJS
        Route::post('/ajax/bpjs/list/faskes', 'ReferensiController@ajaxListFaskes');
        Route::post('/ajax/bpjs/list/dpjp', 'ReferensiController@ajaxListDpjp');
        Route::post('/ajax/bpjs/list/diagnosa', 'ReferensiController@ajaxListDiagnosa');
        Route::post('/ajax/bpjs/list/poli', 'ReferensiController@ajaxListPoli');
        Route::post('/ajax/bpjs/list/rujukan', 'RujukanController@ajaxListRujukanBpjs');
        Route::post('/ajax/bpjs/list/rujukanrs', 'RujukanController@ajaxListRujukanRsBpjs');
        Route::post('/ajax/bpjs/list/sep', 'SepController@ajaxListSep');
        Route::post('/ajax/bpjs/peserta', 'PesertaController@ajaxPesertaBpjs');

        Route::post('/ajax/bpjs/rujukan', 'RujukanController@ajaxRujukanBpjs');
        Route::post('/ajax/bpjs/rujukanrs', 'RujukanController@ajaxRujukanRsBpjs');
        Route::post('/ajax/bpjs/rujukan/peserta', 'RujukanController@ajaxRujukanPeserta');
        Route::post('/ajax/bpjs/rujukan/rs/peserta', 'RujukanController@ajaxRujukanRsPeserta');

        Route::post('/ajax/bpjs/carisep', 'SepController@ajaxCariSep');
        Route::post('/ajax/bpjs/insertsep', 'SepController@ajaxInsertSepBpjs');
        Route::put('/ajax/bpjs/updatesep', 'SepController@ajaxUpdateSepBpjs');
        Route::post('/ajax/bpjs/sep/pulang', 'SepController@ajaxUpdatePulang');

        // CREATE RUJUKAN
        Route::post('/ajax/bpjs/insertrujukan', 'RujukanController@ajaxInsertRujukanBpjs');

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
