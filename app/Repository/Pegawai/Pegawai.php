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
        return DB::table('pegawai')->select(
            'kode_pegawai','nama_pegawai','jenis_kelamin','tempat_lahir', 'tanggal_lahir','divisi.nama_divisi'
        )
        ->join('divisi', 'pegawai.kode_divisi','=','divisi.kode_divisi')
        ->where('pegawai.kode_pegawai', $kodePegawai)
        ->first();
    }

    public function getUltahPegawai($hari, $bulan)
    {
        $data = DB::table('pegawai')->select('kd_pegawai','nama_pegawai','tgl_lahir','unit_kerja','foto')
                ->whereMonth('tgl_lahir', $bulan)
                ->whereDay('tgl_lahir', $hari)
                ->get();
        return $data;
    }
}