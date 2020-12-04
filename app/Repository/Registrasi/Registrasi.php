<?php

namespace App\Repository\Registrasi;

use DB;

class Registrasi
{
    protected $dbsimrs = "sqlsrv_simrs";
      
    public function getRegistrasi($params)
    {
        // dd($params->all());
        // dd($params->tanggal_reg, tanggalFormat($params->tanggal_reg));
        return DB::connection($this->dbsimrs)->table('registrasi as r')
                ->select('r.no_reg','r.no_rm','cb.keterangan','r.status_keluar','r.kd_cara_bayar','p.nama_pasien','r.tgl_reg','r.no_sjp')
                ->join('pasien as p', 'r.no_rm','=','p.no_rm')
                ->join('cara_bayar as cb', 'r.kd_cara_bayar','=','cb.kd_cara_bayar')
                ->where([
                    ['r.tgl_reg','=', tanggalFormat($params->tanggal_reg)],
                    ['r.jns_rawat','=', $params->jns_rawat],
                ])
                ->where(function($query) use ($params) {
                    if ($term = $params->term) {
                        $keywords = "%". $term . "%";
                        $query->orWhere('p.nama_pasien','like', $keywords)
                              ->orWhere('r.no_rm', 'like', $keywords)
                              ->orWhere('r.no_reg', 'like', $keywords);
                    }
                    if ($carabayar = $params->cara_bayar) {
                        $query->orWhere('r.kd_cara_bayar', $carabayar);
                    }
                })
                ->get();
    }

    public function getRegistrasiDetail($params)
    {
        return DB::connection($this->dbsimrs)->table('registrasi as r')
                ->select('r.no_reg','r.tgl_reg','r.no_sjp','r.jns_rawat','pp.no_kartu','r.kd_asal_pasien','r.kd_cara_bayar','r.user_id')
                ->join('penjamin_pasien as pp', function($join) {
                    $join->on('r.no_rm','=','pp.no_rm')
                        ->on('r.kd_penjamin','=','pp.kd_penjamin');
                })
                ->where('r.no_reg',$params->no_reg)
                ->first();
    }

    public function getRawatInap($noReg)
    {
        return DB::connection($this->dbsimrs)->table('rawat_inap as ri')
                ->select('ri.no_reg','ri.no_rm','p.alamat','p.nama_pasien','p.no_telp','p.nik','p.tgl_lahir', 'pg.nama_pegawai','su.nama_sub_unit')
                ->join('pasien as p', 'ri.no_rm','p.no_rm')
                ->join('pegawai as pg', 'ri.kd_dokter','pg.kd_pegawai')
                ->join('tempat_tidur as tt',function($join){
                    $join->on('ri.kd_tempat_tidur','=','tt.kd_tempat_tidur')
                        ->join('kamar as k', function($join) {
                            $join->on('tt.kd_kamar','=','k.kd_kamar')
                                ->join('sub_unit as su',function($join) {
                                    $join->on('k.kd_sub_unit','=','su.kd_sub_unit');
                                });
                        });
                })
                ->where('ri.no_reg', $noReg)
                ->first();
    }

    public function getRawatJalan($noReg)
    {
        return DB::connection($this->dbsimrs)->table('rawat_jalan as rj')
                ->select('rj.no_reg','rj.no_rm','p.alamat','p.nama_pasien','p.no_telp','p.nik','p.tgl_lahir','pg.nama_pegawai','su.nama_sub_unit')
                ->join('pasien as p','rj.no_rm','p.no_rm')
                ->join('pegawai as pg','rj.kd_dokter','pg.kd_pegawai')
                ->join('sub_unit as su', function($join) {
                    $join->on('rj.kd_poliklinik', '=', 'su.kd_sub_unit');
                })
                ->where('rj.no_reg', $noReg)
                ->first();
    }

    public function getRawatDarurat($noReg)
    {
        return DB::connection($this->dbsimrs)->table('rawat_darurat as rd')
                ->select('rd.no_reg','rd.no_rm','p.alamat','p.nama_pasien','p.no_telp','p.nik','p.tgl_lahir')
                ->join('pasien as p','rd.no_rm','p.no_rm')
                ->join('pegawai as pg','rd.kd_dokter','pg.kd_pegawai')
                ->join('pegawai as pg', function($join) {
                    $join->on('rd.kd_dokter','=','pg.kd_pegawai')
                        ->join('sub_unit as su', function($join) {
                            $join->on('pg.kd_sub_unit','=','su.kd_sub_unit');
                        });
                })
                ->where('rd.no_reg', $noReg)
                ->first();
    }
    
}