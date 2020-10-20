<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pembayaran')->insert([
            'kode_pembayaran' => 'PB20201020001',
            'nama_pembayaran' => 'BIAYA_PROSES',
            'keterangan' => 'UNTUK BIAYA PROSES'
        ]);
        DB::table('pembayaran')->insert([
            'kode_pembayaran' => 'PB20201020002',
            'nama_pembayaran' => 'BIAYA_PAJAK',
            'keterangan' => 'UNTUK BIAYA PAJAK'
        ]);
    }
}
