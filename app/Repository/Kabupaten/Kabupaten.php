<?php

namespace App\Repository\Kabupaten;

use DB;

class Kabupaten
{
    protected $dbsimrs = "sqlsrv_simrs";

    public function getKabupaten($params)
    {
        return DB::connection($this->dbsimrs)->table('kabupaten_bpjs')
            ->select('kode', 'nama')
            ->where('kd_prov', $params->kd_prov)
            ->get();
    }
}