<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_rekamedis')->unique()->index();
            $table->string('no_nik')->unique()->index();
            $table->string('nama_pasien');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('alamat_pasien');
            $table->string('rt_pasien');
            $table->string('rw_pasiwn');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kabupaten_kota');
            $table->string('propinsi');
            $table->string('no_telepon');
            $table->string('status_kawin_pasien');
            $table->string('kondisi_masuk_pasien');
            $table->string('sukubangsa_pasien');
            $table->string('agama_pasien');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->string('golongan_darah_pasien')->nullable();
            $table->string('nama_pasangan_pasien')->nullable();
            $table->string('pekerjaan_pasangan_pasien')->nullable();
            $table->string('alamat_pasangan_pasien')->nullable();
            $table->string('no_telepon_pasangan')->nullable();
            $table->string('penanggungjawab_pasien');
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('status_hidup_pasien');
            $table->date('tanggal_meninggal')->nullable();
            $table->date('tanggal_rekamedis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasien');
    }
}
