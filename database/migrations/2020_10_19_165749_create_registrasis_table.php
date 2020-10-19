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
            $table->string('no_registrasi')->unique();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('pekerjaan_id');
            $table->string('no_akta');
            $table->string('lokasi_akta');
            $table->date('tanggal_registrasi');
            $table->string('user_id');
            $table->timestamps();

            $table->foreign('pekerjaan_id')->references('id')->on('pekerjaan');
            $table->foreign('client_id')->references('id')->on('client');
            $table->foreign('user_id')->references('id')->on('users');
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
