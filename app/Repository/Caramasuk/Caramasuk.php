<?php

namespace App\Repository\Caramasuk;

use DB;

class Caramasuk
{
    protected $dbsimrs = "sqlsrv_simrs";

    public function getListCaramasuk()
    {
        return DB::connection($this->dbsimrs)->table('asal_pasien')
            ->select('kd_asal_pasien', 'keterangan')
            ->get();
    }
}