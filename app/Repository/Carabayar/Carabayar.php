<?php

namespace App\Repository\Carabayar;

use DB;

class Carabayar
{
    protected $dbsimrs = "sqlsrv_simrs";

    public function getCarabayar()
    {
        return DB::connection($this->dbsimrs)->table('cara_bayar')
            ->select('kd_cara_bayar', 'keterangan')
            ->where('aktif', 1)
            ->get();
    }
}