<?php

namespace App\Repository\Divisi;

use DB;

class Divisi 
{
    public function getDivisi()
    {
        return DB::table('divisi')->select('kode_divisi', 'nama_divisi')->get();
    }
}