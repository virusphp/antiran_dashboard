<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsesPekerjaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proses_pekerjaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_proses');
            $table->string('nama_proses', 100)->nullable();
            $table->integer('waktu_proses')->nullable();
            $table->char('status_proses', 1)->nullable()->comment('0: semua pekerjaan, 1: status milik bpn');
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
        Schema::dropIfExists('proses_pekerjaan');
    }
}
