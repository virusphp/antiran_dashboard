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
                              ->orWhere('r.no_sjp', 'like', $keywords)
                              ->orWhere('r.no_reg', 'like', $keywords);
                    }
                    if ($carabayar = $params->cara_bayar) {
                        $query->orWhere('r.kd_cara_bayar', '=', $carabayar);
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
                ->select('ri.no_reg','ri.no_rm','p.alamat','p.nama_pasien','p.no_telp','p.nik','p.tgl_lahir', 'pg.nama_pegawai','su.nama_sub_unit', 'ru.kd_instansi')
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
                ->leftJoin('rujukan as ru', 'ri.no_reg', 'ru.no_reg')
                ->where('ri.no_reg', $noReg)
                ->first();
    }

    public function getRawatJalan($noReg)
    {
        return DB::connection($this->dbsimrs)->table('rawat_jalan as rj')
                ->select('rj.no_reg','rj.no_rm','p.alamat','p.nama_pasien','p.no_telp','p.nik','p.tgl_lahir','pg.nama_pegawai','su.nama_sub_unit', 'ru.kd_instansi')
                ->join('pasien as p','rj.no_rm','p.no_rm')
                ->join('pegawai as pg','rj.kd_dokter','pg.kd_pegawai')
                ->join('sub_unit as su', function($join) {
                    $join->on('rj.kd_poliklinik', '=', 'su.kd_sub_unit');
                })
                ->leftJoin('rujukan as ru', 'rj.no_reg', 'ru.no_reg')
                ->where('rj.no_reg', $noReg)
                ->first();
    }

    public function getRawatDarurat($noReg)
    {
        return DB::connection($this->dbsimrs)->table('rawat_darurat as rd')
                ->select('rd.no_reg','rd.no_rm','p.alamat','p.nama_pasien','p.no_telp','p.nik','p.tgl_lahir')
                ->join('pasien as p','rd.no_rm','p.no_rm')
                ->join('pegawai as pg', function($join) {
                    $join->on('rd.kd_dokter','=','pg.kd_pegawai')
                        ->join('sub_unit as su', function($join) {
                            $join->on('pg.kd_sub_unit','=','su.kd_sub_unit');
                        });
                })
                ->where('rd.no_reg', $noReg)
                ->first();
    }

    public function getRegistrasiPasien($noReg)
    {
         return DB::connection($this->dbsimrs)->table('registrasi as reg')
                ->select('reg.no_reg','reg.tgl_reg','reg.no_sjp as no_sep','p.alamat','kl.nama_kelurahan','kc.nama_kecamatan',
                        'kb.nama_kabupaten','pr.nama_propinsi')
                ->join('pasien as p', function($join) {
                    $join->on('reg.no_rm', '=', 'p.no_rm');
                })
                ->join('kelurahan as kl', function($join) {
                    $join->on('p.kd_kelurahan', '=', 'kl.kd_kelurahan');
                })
                ->join('kecamatan as kc', function($join) {
                    $join->on('kl.kd_kecamatan','=','kc.kd_kecamatan');
                })
                ->join('kabupaten as kb', function($join) {
                    $join->on('kc.kd_kabupaten','=','kb.kd_kabupaten');
                })
                ->join('propinsi as pr', function($join) {
                    $join->on('kb.kd_propinsi','=','pr.kd_propinsi');
                })
                ->where('reg.no_reg', $noReg)->first();
    }

    public function getRawatJalanDetail($noReg)
    {
        return DB::connection($this->dbsimrs)->table('registrasi as reg')
                ->select('reg.no_reg','reg.tgl_reg','su.nama_sub_unit as nama_poliklinik','rj.kd_poliklinik')
                ->join('rawat_jalan as rj', 'reg.no_reg','=','rj.no_reg')
                ->join('sub_unit as su', function($join) {
                    $join->on('rj.kd_poliklinik', '=', 'su.kd_sub_unit');  
                })
                ->where('rj.no_reg', '=', $noReg)
                ->first();
    }

    public function getRegistrasiAntrian($params)
    {
        // return DB::connection($this->dbsimrs)->table('registrasi as reg')
        //         ->select(DB::raw("ROW_NUMBER() OVER (ORDER BY rj.no_reg ASC) as noantrian"))
        //         ->whereIn('noantrian', function($query) {
        //             $query->select()
        //         })
        // return DB::connection($this->dbsimrs)
        //         ->select("SELECT noantrian FROM (
        //             SELECT ROW_NUMBER() OVER (ORDER BY rj.no_reg ASC) as noantrian) FROM registrasi as r 
        //                  INNER JOIN rawat_jalan as rj on r.no_reg=rj.no_reg WHERE rj.kd_poliklinik='".$params->kd_poliklinik."'
        //                  AND r.tgl_reg='".tanggalFormat($params->tgl_reg)."') as registrasi_pasien WHERE no_reg='".$params->no_reg."'");
                // ->where('reg.no_reg',  $params->no_reg)

        return DB::select("
            SELECT noantrian FROM (
                SELECT
                ROW_NUMBER() OVER (ORDER BY rj.no_reg ASC) AS noantrian, rj.no_reg, rj.kd_poliklinik
                FROM dbo.Registrasi as r inner join dbo.Rawat_Jalan as rj on r.no_reg=rj.no_reg 
                where rj.kd_poliklinik='".$params->kd_poliklinik."' and r.tgl_reg = '".tanggalFormat($params->tgl_reg)."'
            ) AS regis_pasien
            WHERE no_reg = '".$params->no_reg."'
            ");
    }

    public function getRegistrasiBpjs($jenisRawat)
    {
        $tgl = date('Y-m-d');
        return DB::table('registrasi')
        ->where([
            ['tgl_reg', '=', $tgl],
            ['kd_cara_bayar', '=', 8],
            ['status_keluar', '!=', 2],
            ['jns_rawat', '=', $jenisRawat]
        ])
        ->whereRaw('LEN(no_sjp) > 15')
        ->count();
    }
    
}