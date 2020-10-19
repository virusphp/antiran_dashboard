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
            $table->date('tanggal_kwitansi');
            $table->text('keterangan');
            $table->char('status_bayar',1)->default(0);
            $table->decimal('total',10,0)->default(0);
            
            $table->string('no_registrasi');
            $table->string('kode_pegawai');

            $table->foreign('no_registrasi')
                  ->references('no_registrasi')
                  ->on('registrasi');
                  
            $table->foreign('kode_pegawai')
                  ->references('kode_pegawai')
                  ->on('pegawai');

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
        Schema::dropIfExists('kwitansi');
    }
}
