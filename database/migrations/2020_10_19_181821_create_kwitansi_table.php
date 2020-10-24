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
        Schema::create('kwitansi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_kwitansi')->unique()->index();
            $table->string('no_tagihan');
            $table->string('kode_pembayaran');
            $table->decimal('jumlah_bayar');
            $table->string('no_referensi');
            $table->date('tanggal_kwitansi');
            $table->uuid('user_id');
            $table->timestamps();

            $table->foreign('no_tagihan')
                  ->references('no_tagihan')
                  ->on('tagihan');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
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
