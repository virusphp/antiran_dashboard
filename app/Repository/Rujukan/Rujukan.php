<?php

namespace App\Repository\Rujukan;

use App\Models\RujukanKeluarT;
use App\Service\Bpjs\Rujukan as AppRujukan;
use DB;

class Rujukan
{
    protected $dbsimrs = "sqlsrv_simrs";

    protected $service;

    public function __construct()
    {
        $this->service = new AppRujukan;
    }

    public function getRujukanInternal($params)
    {
        return DB::connection($this->dbsimrs)->table('surat_rujukan_internal')
            ->where('no_rujukan_bpjs', $params->no_rujukan)
            ->get();
    }

    public function getRujukanKeluar($noRujukan)
    {
        return DB::connection($this->dbsimrs)->table('rujukan_keluar_t')
            ->select('no_sep','nama_asal_rujukan','nama_diagnosa','no_rujukan','jns_pelayanan','tipe_rujukan','hak_kelas',
                    'jns_peserta','kelamin','nama_peserta', 'tgl_lahir', 'no_kartu','no_rekamedik','nama_poli','tgl_rujukan','nama_tujuan_rujukan', 
                    'catatan','user')
            ->where('no_rujukan', $noRujukan)
            ->first();
    }

    public function getRujukan($params)
    {
        return RujukanKeluarT::select(
            'no_sep','no_rekamedik','nama_peserta','no_kartu','no_rujukan','nama_tujuan_rujukan','tgl_rujukan'
            )
            ->whereDate('tgl_rujukan','=', tanggalFormat($params->tgl_rujukan))
            ->where(function($query) use ($params) {
                if ($term = $params->term) {
                    $keywords = "%". $term . "%";
                    $query->orWhere('pasien.nama_peserta','like', $keywords)
                          ->orWhere('pasien.no_rekamedik', 'like', $keywords)
                          ->orWhere('no_rujukan', 'like', $keywords);
                }
            })
            ->get();
    }

    public function getDetailRujukan($params)
    {
        return RujukanKeluarT::select(
                'no_sep','jns_pelayanan','tgl_rujukan','tipe_rujukan','kode_diagnosa','nama_diagnosa',
                'kode_tujuan_rujukan','nama_tujuan_rujukan','kode_poli','nama_poli','catatan')
            ->where('no_sep', $params->no_sep)
            ->first();
    }

    public function insertRujukan($params)
    {
        $req = json_encode($this->mapRujukan($params));
        $result = $this->service->InsertRujukan($req);
        $res = json_decode($result);
        // dd($res);
        if ($res->metaData->code == 200) {
            $noRujukan = $res->response == null ? "xx" : $res->response->rujukan->noRujukan;
            DB::beginTransaction();
            try {
                $dataRequest = $this->handleRequest($params, $noRujukan);
                // dd($dataRequest);
                $this->simpanRujukan($dataRequest['rujukan']);
                DB::commit();
            }  catch (QueryException $e) {
                DB::rollback();
                if ($e->getCode() == "23000") {
                    return $result;
                }
            }
            return $result;
        }
        return $result;
    }

    protected function simpanRujukan($dataRujukan)
    {
        return RujukanKeluarT::create($dataRujukan);
    }

    protected function handleRequest($params, $noRujukan)
    {
        $data['rujukan'] = [
            'no_sep' => $params['no_sep'],
            'kode_asal_rujukan' => $params['kode_asal_rujukan'],
            'nama_asal_rujukan' => $params['nama_asal_rujukan'],
            'kode_diagnosa' => $params['kode_diagnosa'],
            'nama_diagnosa' => $params['nama_diagnosa'],
            // 'no_rujukan' => "xxxx"s
            'no_rujukan' => $noRujukan,
            'jns_pelayanan' => $params['jns_pelayanan'],
            'tipe_rujukan' => $params['tipe_rujukan'],
            'hak_kelas' => $params['hak_kelas'],
            'jns_peserta' => $params['jns_peserta'],
            'kelamin' => $params['jns_kelamin'],
            'nama_peserta' => $params['nama_pasien'],
            'no_kartu' => $params['no_kartu'],
            'no_rekamedik' => $params['no_rekamedik'],
            'tgl_lahir' => $params['tgl_lahir'] == null ? "" : $params['tgl_lahir'],
            'kode_poli' => $params['kode_poli'] == null ? "" : $params['kode_poli'],
            'nama_poli' => $params['nama_poli'] == null ? "" : $params['nama_poli'],
            'tgl_rujukan' => $params['tgl_rujukan'],
            'kode_tujuan_rujukan' => $params['ppk_dirujuk'],
            'nama_tujuan_rujukan' => $params['nama_faskes'],
            'catatan' =>$params['catatan'],
            'user' =>$params['user'] 
        ];

        return $data;
    }

    protected function mapRujukan($params)
    {
        $res['noSep'] = $params['no_sep'];
        $res['tglRujukan'] = $params['tgl_rujukan'];
        $res['ppkDirujuk'] = $params['ppk_dirujuk'];
        $res['jnsPelayanan'] = $params['jns_pelayanan'];
        $res['catatan'] = $params['catatan'];
        $res['diagRujukan'] = $params['kode_diagnosa'];
        $res['tipeRujukan'] = $params['tipe_rujukan'];
        $res['poliRujukan'] = $params['kode_poli'];
        $res['user'] = $params['user'];

        $result = [
            't_rujukan' => $res 
         ];
 
         $request = [
             'request' => $result
         ];

        return $request;
    }
}