<?php

namespace App\Repository\Proses;

use DB;

class Proses
{ 
    public function getProses()
    {
        return DB::table('proses_pekerjaan')->select('kode_proses','nama_proses','waktu_proses','created_at')->get();
    }

    public function getProsesDetail($kode)
    {
        return DB::table('proses_pekerjaan')->select('kode_proses','nama_proses','waktu_proses','created_at')->where('kode_proses', $kode)->first();
    }
}
