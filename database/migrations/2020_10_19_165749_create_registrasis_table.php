<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_registrasi')->unique()->index();
            $table->string('kode_client');
            $table->string('kode_pekerjaan');
            $table->string('no_akta');
            $table->string('lokasi_akta');
            $table->date('tanggal_registrasi');
            $table->uuid('user_id');
            $table->timestamps();

            $table->foreign('kode_pekerjaan')->references('kode_pekerjaan')->on('pekerjaan')->ondelete('restrict');
            $table->foreign('kode_client')->references('kode_client')->on('client')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrasi');
    }
}
