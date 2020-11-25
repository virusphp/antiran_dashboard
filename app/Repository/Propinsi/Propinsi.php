<?php

namespace App\Repository\Propinsi;

use DB;

class Propinsi
{
    protected $dbsimrs = "sqlsrv_simrs";

    public function getPropinsi()
    {
        return DB::connection($this->dbsimrs)->table('propinsi_bpjs')
            ->select('kode', 'nama')
            ->get();
    }
}