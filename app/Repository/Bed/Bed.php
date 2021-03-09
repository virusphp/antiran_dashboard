<?php

namespace App\Repository\Bed;

use DB;

class Bed
{
    protected $dbsimrs = "sqlsrv_simrs";

    public function bedAplicare()
    {
        return DB::connection($this->dbsimrs)->table('Tempat_Tidur as tt')
            ->select('tt.keterangan','tt.status','su.nama_sub_unit','kmr.kd_kelas','kls.nama_kelas','jk.nama_jenis_kamar','kmr.kelamin')
            ->join('Kamar as kmr', function($join){
                $join->on('tt.kd_kamar','=', 'kmr.kd_kamar')
                    ->join('sub_unit as su', function($join) {
                        $join->on('kmr.kd_sub_unit', '=', 'su.kd_sub_unit');
                    })
                    ->join('kelas as kls', function($join) {
                        $join->on('kmr.kd_kelas','=', 'kls.kd_kelas');
                    });
            })
            ->join('jenis_kamar as jk', function($join) {
                $join->on('tt.kd_jenis_kamar','=', 'jk.kd_jenis_kamar')
                    ->where("jk.kd_jenis_kamar", "!=", "14");
            })
            ->orderBy('tt.kd_kamar')
            ->whereIn('tt.status', [0,1,2,3,4])
            ->where('tt.aktif', 1)
            ->whereNotNull('tt.kd_jenis_kamar')
            ->whereNotIn('tt.kd_jenis_kamar', [14, 6])
            ->get();
    }
}