<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKwitansiDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('kwitansi_detail', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('no_kwitansi');
        //     $table->string('no_referensi');
        //     $table->unsignedBigInteger('pembayaran_id');
        //     $table->decimal('jumlah_bayar',10,0);

        //     $table->foreign('no_kwitansi')
        //           ->references('no_kwitansi')
        //           ->on('kwitansi');

        //     $table->foreign('pembayaran_id')->references('id')->on('pembayaran');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('kwitansi_detail');
    }
}
