<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTanggalSelesaiRegistrasiDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrasi_detail', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrasi_detail', function (Blueprint $table) {
            // tidak berhasil jadi lansung edit di migration sebelumnya
            // $table->date('tanggal_selesai')->nullable(TRUE)->change();
        });
    }
}
