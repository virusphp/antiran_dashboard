<?php

namespace App\Repository\Instansi;

use DB;

class Instansi
{
    protected $dbsimrs = "sqlsrv_simrs";

    public function getInstansi()
    {
        return DB::connection($this->dbsimrs)->table('instansi_rujukan')
                ->select('kd_instansi', 'nama_instansi')
                ->get();
    }
}