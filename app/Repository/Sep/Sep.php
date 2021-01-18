<?php

namespace App\Repository\Sep;

use App\Service\Bpjs\Sep as AppSep;
use DB;

class Sep
{
    protected $service;
    protected $dbsimrs = "sqlsrv_simrs";

    public function __construct()
    {
        $this->service = new AppSep;
    }

    public function getSep($params)
    {
        return DB::connection($this->dbsimrs)->table('sep_bpjs')
            ->where([['no_reg', '=', $params->no_reg], ['no_sjp', '=', $params->no_sep]])
            ->first();
    }
    
    public function updatePulangSep($data)
    {
        $req = json_encode($this->mapPulang($data));
        $result = $this->service->updatePulang($req);
        $res = json_decode($result);
        // dd($result);
        if ($res->metaData->code == 200) {
            DB::beginTransaction();
            try {
                $this->simpanPulang($data);
                DB::commit();
                return $result;
            } catch (\illuminate\Database\QueryException $e) {
                DB::rollback();
                if ($e->getCode() == "23000") {
                    return $result;
                }
            }
        } else {
            return $result;
        }
    }

    public function insertSep($data)
    { 
        $req = json_encode($this->mapSep($data));
        // dd($data);
        $result = $this->service->InsertSep($req);
        $res = json_decode($result);
        if ($res->metaData->code == 200) {
            if ($res->response->sep->peserta->noKartu == $data['no_kartu'] && $res->response->sep->peserta->noMr == $data['no_rm']) {
                DB::beginTransaction();
                try {
                    // dd($res);
                    $this->simpanSep($data, $res);
                    $this->simpanRujukan($data);
                    DB::commit();
                    return $result;
                } catch (\Illuminate\Database\QueryException $e) {
                    DB::rollback();
                    if ($e->getCode() == "23000") {
                        return $result;
                    }
                } 
            //    return $result;
            } else {
                $message = $this->getMessage($result);
                return $message;
            }
        } else {
            return $result;
        }
    }

    protected function getMessage($result) 
    {
        $data['metaData'] = [
            'code' => 201,
            'message' => 'Sep Dengan No : ' .$result->response->sep->noSep .' Adalah jaminan A/N : ' . $result->response->sep->peserta->nama
            // 'message' => 'Sep Dengan No : XXXX Adalah jaminan A/N : UUUU'
        ];
        $data['response'] = null;

        return $data;
    }

    public function updateSep($data)
    { 
        $req = json_encode($this->mapUpdateSep($data));
        $result = $this->service->UpdateSep($req);
        $res = json_decode($result);
        if ($res->metaData->code == 200) {
            DB::beginTransaction();
            try {
                $this->perbaruiSep($data, $res);
                $this->simpanRujukan($data);
                DB::commit();
                return $result;
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollback();
                if ($e->getCode() == "23000") {
                    return $result;
                }
            } 
        }
        return $result;
    }

    protected function simpanRujukan($dataRequest)
    {
        if ($dataRequest['jns_pelayanan'] == 2 ) {
            
            $uRujukan = DB::connection($this->dbsimrs)->table('Rujukan')
                ->where('no_reg', '=', $dataRequest['no_reg'])
                ->update([
                    'no_rujukan' => $dataRequest['no_rujukan'],
                    'kd_instansi' => $dataRequest['nama_instansi']
                ]);

            if (!$uRujukan){
                $uRujukan = DB::connection($this->dbsimrs)->table('Rujukan')
                    ->insert([
                        'no_rujukan' => $dataRequest['no_rujukan'],
                        'no_reg' => $dataRequest['no_reg'],
                        'no_RM' => $dataRequest['no_rm'],
                        'tgl_rujukan' => $dataRequest['tgl_rujukan'],
                        'kd_instansi' => '1105R001  ',
                        'nama_pengirim' => '-',
                        'kd_ICD' => '-',
                        'kd_SMF' => '-',
                        'Diagnosa_Sementara' => $dataRequest['kode_diagnosa']. ' '. $dataRequest['nama_diagnosa']
                    ]);
            }
            
            if ($dataRequest['asal_pasien'] != null) {
                $updateReg = DB::connection($this->dbsimrs)->table('Registrasi')
                    ->where('no_reg', '=', $dataRequest['no_reg'])
                    ->update([
                        'kd_asal_pasien' => $dataRequest['asal_pasien'],
                        'user_id' => $dataRequest['user']
                    ]);
            }
        } else {
            $uRujukan = DB::connection($this->dbsimrs)->table('Rujukan')
                ->where('no_reg', '=', $dataRequest['no_reg'])
                ->first();

            if (!$uRujukan) {
                $uRujukan = DB::connection($this->dbsimrs)->table('Rujukan')
                ->insert([
                    'no_rujukan' => $dataRequest['no_rujukan'],
                    'no_reg' => $dataRequest['no_reg'],
                    'no_RM' => $dataRequest['no_rm'],
                    'tgl_rujukan' => $dataRequest['tgl_rujukan'],
                    'kd_instansi' => '1105R001  ',
                    'nama_pengirim' => '-',
                    'kd_ICD' => '-',
                    'kd_SMF' => '-',
                    'Diagnosa_Sementara' => $dataRequest['kode_diagnosa']. ' '. $dataRequest['nama_diagnosa']
                ]);
            }
        }

        return $uRujukan;
    }

    protected function simpanPulang($dataRequest)
    {
        $simpanPlg = DB::table('SEP_PULANG')->insert([
            'no_sep' => $dataRequest['noSep'],
            'tgl_pulang' => $dataRequest['tglPulang'],
            'user' => $dataRequest['user']
        ]);
        return $simpanPlg;
    }

    protected function perbaruiSep($dataRequest, $dataResponse)
    {
        $updateSep = DB::connection($this->dbsimrs)->table('sep_bpjs')->where([
                ['no_SJP', '=', $dataResponse->response],
                ['no_reg', '=', $dataRequest['no_reg']]
            ])
            ->update([
                'no_reg' => $dataRequest['no_reg'],
                'no_SJP' => $dataResponse->response,
                'COB' => $dataRequest['cob'],
                'Kd_Faskes' => $dataRequest['ppk_rujukan'],
                'Nama_Faskes' => $dataRequest['nama_faskes'],
                'Kd_Diagnosa' => $dataRequest['kode_diagnosa'],
                'Nama_Diagnosa' => $dataRequest['nama_diagnosa'],
                'Kd_poli' => $dataRequest['kode_poli'],
                'Nama_Poli' => $dataRequest['nama_poli'],
                'Kd_Kelas_Rawat' => $dataRequest['kelas_rawat'],
                'Nama_kelas_rawat' => $dataRequest['nama_kelas'],
                'No_Rujukan' => $dataRequest['no_rujukan'],
                'Asal_Faskes' => $dataRequest['asal_rujukan'],
                'Tgl_Rujukan' => $dataRequest['tgl_rujukan'],
                'Lakalantas' => $dataRequest['lakalantas'],
                'no_surat_kontrol' => $dataRequest['no_surat'],
                'kd_dpjp' => $dataRequest['kode_dpjp']
            ]);
        return $updateSep;
    }

    protected function simpanSep($dataRequest, $dataResponse)
    {
          $simpanSep = DB::connection($this->dbsimrs)->table('sep_bpjs')->insert([
            'no_reg' => $dataRequest['no_reg'],
            'no_SJP' => $dataResponse->response->sep->noSep,
            'COB' => $dataRequest['cob'],
            'Kd_Faskes' => $dataRequest['ppk_rujukan'],
            'Nama_Faskes' => $dataRequest['nama_faskes'],
            'Kd_Diagnosa' => $dataRequest['kode_diagnosa'],
            'Nama_Diagnosa' => $dataRequest['nama_diagnosa'],
            'Kd_poli' => $dataRequest['kode_poli'],
            'Nama_Poli' => $dataRequest['nama_poli'],
            'Kd_Kelas_Rawat' => $dataRequest['kelas_rawat'],
            'Nama_kelas_rawat' => $dataRequest['nama_kelas'],
            'No_Rujukan' => $dataRequest['no_rujukan'],
            'Asal_Faskes' => $dataRequest['asal_rujukan'],
            'Tgl_Rujukan' => $dataRequest['tgl_rujukan'],
            'Lakalantas' => $dataRequest['lakalantas'],
            'no_surat_kontrol' => $dataRequest['no_surat'],
            'kd_dpjp' => $dataRequest['kode_dpjp']
        ]);

        if ($simpanSep) {
            $simpanSep = DB::connection($this->dbsimrs)->table('registrasi')
                ->where('no_reg', '=', $dataRequest['no_reg'])
                ->update([
                    'no_SJP' => $dataResponse->response->sep->noSep
                ]);
        }
        
        return $simpanSep;
    }

    protected function mapPulang($data)
    {
        $res['noSep'] = $data['no_sep_p'];
        $res['tglPulang'] = $data['tgl_pulang'];
        $res['user'] = $data['user'];
        $result = [
            't_sep' => $res
        ];

        $request = [
            'request' => $result
        ];

        return $request;
    }

    protected function mapSep($data)
    {
        $res['noKartu'] = $data['no_kartu'];
        $res['tglSep'] = $data['tgl_sep'];
        $res['ppkPelayanan'] = $data['ppk_pelayanan'];
        $res['jnsPelayanan'] = $data['jns_pelayanan'];
        $res['klsRawat'] = $data['kelas_rawat'];
        $res['noMR'] = $data['no_rm'];
        $res['rujukan'] = [
            'asalRujukan' => $data['asal_rujukan'],
            'tglRujukan' => $data['tgl_rujukan'],
            'noRujukan' => $data['no_rujukan'],
            'ppkRujukan' => $data['ppk_rujukan']
        ];
        $res['catatan'] = $data['catatan'];
        $res['diagAwal'] = $data['kode_diagnosa'];
        $res['poli'] = [
            'tujuan' => $data['kode_poli'],
            'eksekutif' => $data['eksekutif']
        ];

        $res['cob'] = [
            'cob' => $data['cob']
        ];

        $res['katarak'] = [
           'katarak' => $data['katarak'] 
        ];

        $lokasiLaka = [
            'kdPropinsi' => $data['propinsi'],
            'kdKabupaten' => $data['kabupaten'],
            'kdKecamatan' => $data['kecamatan']
        ];

         $suplesi = [
            'suplesi' => $data['suplesi'],
            'noSepSuplesi' => $data['no_sep_suplesi'],
            'lokasiLaka' => $lokasiLaka
        ];

        $penjamin = [
            'penjamin' => $data['penjamin'],
            'tglKejadian' => $data['tgl_kejadian'],
            'keterangan' => $data['keterangan'],
            'suplesi' => $suplesi
        ];

        $res['jaminan'] = [
            'lakaLantas' => $data['lakalantas'],
            'penjamin' => $penjamin
        ]; 
        
        $res['skdp'] = [
            'noSurat' => $data['no_surat'],
            'kodeDPJP' => $data['kode_dpjp']
        ];

        $res['noTelp'] = $data['no_telp'];
        $res['user'] = $data['user'];

        $result = [
           't_sep' => $res 
        ];

        $request = [
            'request' => $result
        ];

        return $request;
    }

    protected function mapUpdateSep($data)
    {
        $res['noSep'] = $data['no_sep'];
        $res['tglSep'] = $data['tgl_sep'];
        $res['ppkPelayanan'] = $data['ppk_pelayanan'];
        $res['jnsPelayanan'] = $data['jns_pelayanan'];
        $res['klsRawat'] = $data['kelas_rawat'];
        $res['noMR'] = $data['no_rm'];
        $res['rujukan'] = [
            'asalRujukan' => $data['asal_rujukan'],
            'tglRujukan' => $data['tgl_rujukan'],
            'noRujukan' => $data['no_rujukan'],
            'ppkRujukan' => $data['ppk_rujukan']
        ];
        $res['catatan'] = $data['catatan'];
        $res['diagAwal'] = $data['kode_diagnosa'];
        $res['poli'] = [
            'tujuan' => $data['kode_poli'],
            'eksekutif' => $data['eksekutif']
        ];

        $res['cob'] = [
            'cob' => $data['cob']
        ];

        $res['katarak'] = [
           'katarak' => $data['katarak'] 
        ];

        $lokasiLaka = [
            'kdPropinsi' => $data['propinsi'],
            'kdKabupaten' => $data['kabupaten'],
            'kdKecamatan' => $data['kecamatan']
        ];

         $suplesi = [
            'suplesi' => $data['suplesi'],
            'noSepSuplesi' => $data['no_sep_suplesi'],
            'lokasiLaka' => $lokasiLaka
        ];

        $penjamin = [
            'penjamin' => $data['penjamin'],
            'tglKejadian' => $data['tgl_kejadian'],
            'keterangan' => $data['keterangan'],
            'suplesi' => $suplesi
        ];

        $res['jaminan'] = [
            'lakaLantas' => $data['lakalantas'],
            'penjamin' => $penjamin
        ]; 
        
        $res['skdp'] = [
            'noSurat' => $data['no_surat_lama'],
            'kodeDPJP' => $data['kode_dpjp']
        ];

        $res['noTelp'] = $data['no_telp'];
        $res['user'] = $data['user'];

        $result = [
           't_sep' => $res 
        ];

        $request = [
            'request' => $result
        ];

         return $request;
    }
}