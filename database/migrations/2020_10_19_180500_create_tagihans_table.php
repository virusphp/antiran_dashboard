<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_tagihan')->unique()->index();
            $table->string('no_registrasi');
            $table->date('tanggal_tagihan');
            $table->decimal('total_biaya_proses');
            $table->decimal('total_biaya_pajak');
            $table->char('status_bayar',1)->default(0);
            $table->text('keterangan');
            $table->string('kode_pegawai');
            $table->timestamps();

            $table->foreign('no_registrasi')
                  ->references('no_registrasi')
                  ->on('registrasi');
            $table->foreign('kode_pegawai')
                  ->references('kode_pegawai')
                  ->on('pegawai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tagihan');
    }
}
