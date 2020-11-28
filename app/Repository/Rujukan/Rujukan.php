<?php

namespace App\Repository\Rujukan;

use DB;

class Rujukan
{
    protected $dbsimrs = "sqlsrv_simrs";

    public function getRujukanInternal($params)
    {
        return DB::connection($this->dbsimrs)->table('surat_rujukan_internal')
            ->where('no_rujukan_bpjs', $params->no_rujukan)
            ->get();
    }
}