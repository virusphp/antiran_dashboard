<?php

namespace App\Repository\Pasien;
use DB;

class Pasien 
{
    protected $dbsimrs = "sqlsrv_simrs";

    public function getPasien($request)
    {
        $asuransi = $request->get('asuransi');
        // $term = $request->get('term');
        // dd($term);
        
        return DB::connection($this->dbsimrs)
            ->table('pasien as p')
            ->select('p.no_rm','p.nama_pasien','p.tempat_lahir','p.tgl_lahir','p.jns_kel','pp.no_kartu',
                    'p.nik', 'p.alamat', 'p.rt','p.rw', 'k.nama_kelurahan','p.no_telp','sb.nama_suku_bangsa',
                    'a.nama_agama','pd.nama_pendidikan','pk.nama_pekerjaan','p.nama_pasangan','p.pekerjaan_pasangan',
                    'p.no_telp_pasangan','p.alamat_pasangan')
            ->join('penjamin_pasien as pp','p.no_rm','=','pp.no_rm')
            ->join('kelurahan as k', 'p.kd_kelurahan', 'k.kd_kelurahan')
            ->join('suku_bangsa as sb', 'p.kd_suku_bangsa', 'sb.kd_suku_bangsa')
            ->join('agama as a', 'p.kd_agama', 'a.kd_agama')
            ->join('pendidikan as pd', 'p.kd_pendidikan', 'pd.kd_pendidikan')
            ->join('pekerjaan as pk', 'p.kd_pekerjaan', 'pk.kd_pekerjaan')
            ->where(function($query) use ($asuransi) {
                if ($asuransi == 0) {
                    $query->where([
                        ['p.nik', '!=', null],
                        [DB::raw('LEN(p.nik)'), '>', 15],
                        ['pp.no_kartu', '=', '-'],
                    ]);
                } else {
                    $query->where([
                        ['p.nik', '!=', null],
                        [DB::raw('LEN(p.nik)'), '>', 15],
                        [DB::raw('LEN(pp.no_kartu)'), '>=', 9],
                    ]);

                }
            })
            ->where(function($query) use ($request) {
                if ($term = $request->get('term')) {
                    $keywords = '%' . $term . '%';
                    $query->orWhere('p.nama_pasien', 'like', $keywords);
                }
            })
            ->get();
    }

    public function getPasienEdit($noRm)
    {
        return DB::connection($this->dbsimrs)
                ->table('pasien as p')
                ->select('p.no_rm','p.nama_pasien','p.tempat_lahir','p.tgl_lahir','p.jns_kel','pp.no_kartu',
                    'p.nik', 'p.alamat', 'p.rt','p.rw', 'p.kd_kelurahan','p.no_telp','p.kd_suku_bangsa',
                    'p.kd_agama','p.kd_pendidikan','p.kd_pekerjaan','p.nama_pasangan','p.pekerjaan_pasangan',
                    'p.no_telp_pasangan','p.alamat_pasangan','p.nama_orang_tua','p.nama_ayah','p.tgl_lahir_ayah',
                    'p.nama_ibu','p.tgl_lahir_ibu')
                ->leftJoin('penjamin_pasien as pp','p.no_rm','=','pp.no_rm')
                ->where('p.no_rm', $noRm)
                ->first();
    }
}