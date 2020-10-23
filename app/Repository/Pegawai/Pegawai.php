<?php

namespace App\Repository\Pegawai;
use DB;

class Pegawai
{
    public function getPegawai()
    {
        return DB::table('pegawai')->select(
           'kode_pegawai','nama_pegawai','jenis_kelamin','tempat_lahir', 'tanggal_lahir','divisi.nama_divisi'
        )
        ->join('divisi', 'pegawai.kode_divisi','=','divisi.kode_divisi')
        ->get();
    }

    public function getPegawaiDetail($kodePegawai)
    {
        // dd($kodePegawai);
        return DB::connection('sqlsrv_sms')
            ->table('akun as a')
            ->select('a.kd_pegawai','a.mac_address', 'device', 'a.status_update','a.created_at','a.updated_at',
                    'p.nama_pegawai','p.gelar_depan','p.gelar_belakang','su.kd_sub_unit','tempat_lahir','tgl_lahir',
                    'su.nama_sub_unit')
            ->join('dbsimrs.dbo.pegawai as p', 'a.kd_pegawai','=', 'p.kd_pegawai')
            ->join('dbsimrs.dbo.sub_unit as su', 'p.kd_sub_unit','=', 'su.kd_sub_unit')
            ->where('a.kd_pegawai', $kodePegawai)
            ->first();
    }
}