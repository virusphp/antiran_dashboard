<?php

namespace App\Repository\Poliklinik;

use DB;

class Poliklinik
{
    protected $dbsimrs = "sqlsrv_simrs";

    public function getPoliklinik()
    {
        $tanggal_sekarang = date('Y-m-d');

        $dokterPengganti = $this->dokterPengganti($tanggal_sekarang);
        if ($dokterPengganti->count() != 0) {
            foreach($dokterPengganti as $key => $val) {
                if ($val->status_pergantian == 0) {
                    $dokterKlinik = $this->dokterKlinik($tanggal_sekarang);
                    if ($dokterKlinik->count() != 0) {
                        $dokterPengganti[$key]->nama_pegawai = $val->gelar_depan." ".$val->nama_pegawai." ".$val->gelar_belakang;
                        $dokterPengganti[$key]->tanggal = tanggalIndo($tanggal_sekarang);
                        unset($dokterPengganti[$key]->status_pengganti, $dokterPengganti[$key]->gelar_depan,$dokterPengganti[$key]->gelar_belakang);
                    }

                    foreach($dokterKlinik as $key => $val) {
                        $dokterKlinik[$key]->nama_pegawai = $val->gelar_depan." ".$val->nama_pegawai." ".$val->gelar_belakang;
                        $dokterKlinik[$key]->tanggal = tanggalIndo($tanggal_sekarang);
                        unset($dokterKlinik[$key]->gelar_depan,$dokterKlinik[$key]->gelar_belakang);
                    }

                    $jadwalDokter =  collect(array_merge($dokterPengganti->toArray(), $dokterKlinik->toArray()));

                    return $jadwalDokter;
                } else {
                    $dokterKlinik = $this->dokterKlinik($tanggal_sekarang);

                    foreach($dokterKlinik as $key => $val) {
                        $dokterKlinik[$key]->nama_pegawai = $val->gelar_depan." ".$val->nama_pegawai." ".$val->gelar_belakang;
                        $dokterKlinik[$key]->tanggal = tanggalIndo($tanggal_sekarang);
                        unset($dokterKlinik[$key]->gelar_depan,$dokterKlinik[$key]->gelar_belakang);
                    }

                    return $dokterKlinik;
                }
            } 
        } else {
            $dokterKlinik = $this->dokterKlinik($tanggal_sekarang);
            
            if ($dokterKlinik->count() != 0) {
                foreach($dokterKlinik as $key => $val) {
                    $dokterKlinik[$key]->nama_pegawai = $val->gelar_depan." ".$val->nama_pegawai." ".$val->gelar_belakang;
                    $dokterKlinik[$key]->tanggal = tanggalIndo($tanggal_sekarang);
                    unset($dokterKlinik[$key]->gelar_depan,$dokterKlinik[$key]->gelar_belakang);
                }

                return $dokterKlinik;
            }
        }

    }

    protected function dokterKlinik($tglSekarang)
    {
        return DB::table('Jadwal_Dokter_Poli_RJ AS DP')
        ->where('DP.kd_hari','=', tanggalNilai($tglSekarang))
        ->select('DP.kd_pegawai','DP.kd_sub_unit','SU.nama_sub_unit',
                'gelar_depan','gelar_belakang','nama_pegawai', 'TKR.kd_tarif','TKR.rek_p','TKR.harga')
        ->join('Pegawai AS P',function($join){
            $join->on('DP.Kd_Pegawai','=','P.kd_pegawai');
        })
        ->join('Sub_Unit AS SU', function($join){
            $join->on('DP.kd_sub_unit', '=', 'SU.kd_sub_unit')
                ->join('tarif_karcis_rj as TKR', function($join){
                    $join->on('SU.kd_sub_unit','TKR.kd_sub_Unit');
                })
                ->where('SU.enabled', '=', 1);
        })
        ->orderBy('SU.nama_sub_unit', 'asc')
        ->get();
    }

    protected function dokterPengganti($tglSekarang)
    {
        return DB::table('Jadwal_Dokter_Poli_RJ_Pengganti AS DPP')
            ->select('DPP.kd_pegawai', 'SU.kd_sub_unit','SU.nama_sub_unit',
            'P.gelar_depan','P.gelar_belakang','P.nama_pegawai','DPP.status_pergantian','TKR.kd_tarif','TKR.rek_p','TKR.harga')
            ->join('Pegawai AS P',function($join){
                $join->on('DPP.kd_pegawai','=','P.kd_pegawai');
            })
            ->join('Sub_Unit AS SU', function($join){
                $join->on('DPP.kd_sub_unit', '=', 'SU.kd_sub_unit')
                ->join('tarif_karcis_rj as TKR', function($join){
                    $join->on('SU.kd_sub_unit','TKR.kd_sub_Unit');
                })
                ->where('SU.enabled', '=', 1);
            })
            ->where('DPP.tanggal','=', $tglSekarang)
            ->orderBy('SU.nama_sub_unit', 'asc')
            ->get();
    }


}