<?php
namespace App\Repository;

use DB;

class Antrian 
{
    protected $dbsimrs = "sqlsrv_simrs";

    public function getRekap($request)
    {
        return DB::connection($this->dbsimrs)->table('rawat_jalan as rj')
            ->select('r.tgl_reg','rj.kd_poliklinik','su.nama_sub_unit', DB::raw('COUNT(rj.kd_poliklinik) as jumlah_antrian'))
            ->join('registrasi as r','rj.no_reg', '=','r.no_reg')
            ->join('sub_unit as su', 'rj.kd_poliklinik','=', 'su.kd_sub_unit')
            ->groupBy('su.nama_sub_unit','rj.kd_poliklinik', 'r.tgl_reg')
            ->where(function($query) use ($request) {
                if($tanggal = $request->get('tanggal')) {
                    $query->where('r.tgl_reg', $tanggal);
                }
            })
            ->orWhere(function($query) use ($request) {
                if ($term = $request->get('term')) {
                    $keywords = '%'. $term . '%';
                    $query->where('r.tgl_reg', 'like', $keywords);
                    $query->where('r.no_rm', 'like', $keywords);
                }
            })
            ->get();
    }
}