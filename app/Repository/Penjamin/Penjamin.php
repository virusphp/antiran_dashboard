<?php

namespace App\Repository\Penjamin;

use DB;

class Penjamin
{
    protected $dbsimrs = "sqlsrv_simrs";

    public function getListPenjamin($params)
    {
        return DB::connection($this->dbsimrs)->table('penjamin')
        ->select('kd_penjamin', 'nama_penjamin')
        ->where(function($query) use ($params) {
            if ($params['carabayar'] == 3) {
                $query->whereNotIn('kd_penjamin', [23, 24]);
            } else if($params['carabayar'] == 8) {
                $query->whereIn('kd_penjamin', [23, 24]);
            }
        })
        ->get();
    }
}