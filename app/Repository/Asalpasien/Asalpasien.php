<?php

namespace App\Repository\Asalpasien;

use DB;

class Asalpasien
{
    protected $dbsimrs = "sqlsrv_simrs";

    public function getAsalPasien()
    {
        return DB::connection($this->dbsimrs)->table('asal_pasien')
                ->select('kd_asal_pasien', 'keterangan')
                ->get();
    }
}