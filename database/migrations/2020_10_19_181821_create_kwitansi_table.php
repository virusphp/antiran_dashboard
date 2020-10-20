<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKwitansiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Kwitansi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_tagihan')->unique()->index();
            $table->string('kode_pembayaran');
            $table->decimal('jumlah_bayar');
            $table->string('no_referensi');
            $table->date('tanggal_tagihan');
            $table->string('kode_pegawai');
            $table->timestamps();

            $table->foreign('no_tagihan')
                  ->references('no_tagihan')
                  ->on('tagihan');
            $table->foreign('kode_pegawai')
                  ->references('kode_pegawai')
                  ->on('pegawai');
            $table->foreign('kode_pembayaran')
                  ->references('kode_pembayaran')
                  ->on('pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kwitansi');
    }
}
