<?php

namespace App\Repository\Kecamatan;

use DB;

class Kecamatan
{
    protected $dbsimrs = "sqlsrv_simrs";
    public function getKecamatan($params)
    {
        return DB::connection($this->dbsimrs)->table('kecamatan_bpjs')
            ->select('kode', 'nama')
            ->where('kd_kab', $params->kd_kab)
            ->get();
    }
}