<?php

namespace App\Repository\Skdp;

use DB;

class Skdp 
{
    public function getNomorSurat($params)
    {
        $data = DB::table('Surat_Rujukan_Internal as sri')
            ->select('sri.no_rujukan','sri.no_reg','sri.no_rujukan_bpjs','sri.jenis_surat','p.nama_pegawai', 'su.kd_poli_dpjp')
            ->join('Sub_Unit as su', 'sri.kd_sub_unit','=','su.kd_sub_unit')
            ->join('Pegawai as p', 'sri.kd_dokter','=', 'p.kd_pegawai')
            ->where('no_rujukan_bpjs', '=', $params->no_rujukan)
            ->orderBy('sri.no_rujukan', 'desc')
            ->get();
        return $data;
    }
}