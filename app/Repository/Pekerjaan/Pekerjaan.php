<?php

namespace App\Repository\Pekerjaan;

use App\Models\Pekerjaan as PekerjaanModel;
use DB;

class Pekerjaan
{ 
    public function getPekerjaan()
    {
        return PekerjaanModel::select('id','kode_pekerjaan','nama_pekerjaan','keterangan_pekerjaan','insentif_pekerjaan','created_at')->get();
    }

    public function getPekerjaanDetail($kode)
    {
        return DB::table('pekerjaan')->select('kode_pekerjaan','nama_pekerjaan','insentif_pekerjaan')->where('kode_pekerjaan', $kode)->first();
    }
}
