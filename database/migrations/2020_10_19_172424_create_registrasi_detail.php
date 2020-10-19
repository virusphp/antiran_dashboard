<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrasiDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrasi_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_registrasi');
            $table->unsignedBigInteger('proses_pekerjaan_id');
            $table->string('prioritas');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->foreign('no_registrasi')
                ->references('no_registrasi')
                ->on('registrasi');
<<<<<<< HEAD
               
=======

>>>>>>> 998a6c7b6ac45ac90dc22d89762b92b37b72f6b7
            $table->char('status_proses', '1')
                ->default(0)
                ->comment('0 = belum dikerjakan, 1 = sudah dikerjakan');

            // $table->foreign('proses_pekerjaan_id')
            //     ->references('id')
            //     ->on('proses_pekerjaan')
            //     ->onDelete('cascade');
            //dicomment dulu karena belum ada table proses_pekerjaan

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
        Schema::dropIfExists('registrasi_detail');
    }
}
