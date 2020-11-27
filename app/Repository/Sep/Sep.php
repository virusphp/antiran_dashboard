<?php

namespace App\Repository\Sep;

use App\Service\Bpjs\Sep as AppSep;
use DB;
use Exception;

class Sep
{
    protected $service;
    protected $dbsimrs = "sqlsrv_simrs";

    public function __construct()
    {
        $this->service = new AppSep;
    }

    public function insertSep($data)
    { 
        $req = json_encode($this->mapSep($data));
        $result = $this->service->InsertSep($req);
        $res = json_decode($result);
        if ($res->metaData->code == 200) {
            DB::beginTransaction();
            try {
                $this->simpanSep($data, $result);
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
                ->get();

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

    protected function simpanSep($dataRequest, $dataResponse)
    {
          $simpanSep = DB::connection($this->dbsimrs)->table('sep_bpjs')->insert([
            'no_reg' => $dataRequest['no_reg'],
            'no_SJP' => 'xxx',
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
        
        return $simpanSep;
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
}