<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRujukanKeluarTSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rujukan_keluar_t', function (Blueprint $table) {
            $table->bigIncrements('rujukan_keluar_id');
            $table->string('no_sep');
            $table->string('kode_asal_rujukan');
            $table->string('nama_asal_rujukan');
            $table->string('kode_diagnosa');
            $table->string('nama_diagnosa');
            $table->string('no_rujukan')->nullable();
            $table->string('jns_pelayanan')->nullable();
            $table->string('tipe_rujukan')->nullable();
            $table->string('hak_kelas')->nullable();
            $table->string('jns_peserta')->nullable();
            $table->string('kelamin')->nullable();
            $table->string('nama_peserta');
            $table->string('no_kartu');
            $table->string('no_rekamedik')->nullable();
            $table->string('tgl_lahir');
            $table->string('kode_poli');
            $table->string('nama_poli');
            $table->date('tgl_rujukan');
            $table->string('kode_tujuan_rujukan');
            $table->string('nama_tujuan_rujukan');
            $table->text('catatan')->nullable();
            $table->string('user');
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
        Schema::dropIfExists('rujukan_keluar_t');
    }
}
