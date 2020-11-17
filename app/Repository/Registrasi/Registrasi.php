<?php

namespace App\Repository\Registrasi;

use DB;

class Registrasi
{
    protected $dbsimrs = "sqlsrv_simrs";
      
    public function getRegistrasi($params)
    {
        // dd($params->tanggal_reg, tanggalFormat($params->tanggal_reg));
        return DB::connection($this->dbsimrs)->table('registrasi as r')
                ->select('r.no_reg','r.no_rm','cb.keterangan','r.status_keluar','r.kd_cara_bayar','p.nama_pasien','r.tgl_reg','r.no_sjp')
                ->join('pasien as p', 'r.no_rm','=','p.no_rm')
                ->join('cara_bayar as cb', 'r.kd_cara_bayar','=','cb.kd_cara_bayar')
                ->where('r.tgl_reg','=', tanggalFormat($params->tanggal_reg))
                ->where(function($query) use ($params) {
                    if ($term = $params->term) {
                        $keywords = "%". $term . "%";
                        $query->orWhere('p.nama_pasien','like', $keywords)
                              ->orWhere('r.no_rm', 'like', $keywords)
                              ->orWhere('r.no_reg', 'like', $keywords);
                    }
                })
                ->get();
    }
    
}