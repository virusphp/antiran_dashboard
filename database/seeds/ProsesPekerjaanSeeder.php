<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProsesPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proses_pekerjaan')->insert([
            'kode_proses' => 1,
            'nama_proses' => 'PLOTING',
            'waktu_proses' => 7,
            'status_proses' => '0'
        ]);
    }
}
