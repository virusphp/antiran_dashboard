<?php

namespace App\Repository\Sep;

use App\Service\Bpjs\Sep as AppSep;

class Sep
{
    protected $service;

    public function __construct()
    {
        $this->service = new AppSep;
    }

    public function insertSep($data)
    {
        $req = json_encode($this->mapSep($data));
        $result = json_decode($this->service->InsertSep($req));
        dd($result->metaData->code);
        if ($result->metaData->code == 200) {
            $this->simpanSep($data, $result);
            return $result;
        }

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