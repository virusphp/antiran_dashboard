<?php

namespace App\Http\Controllers\Backend\BridgingBPJS;

use App\Service\Bpjs\Bridging;
use Illuminate\Http\Request;

class SepController extends BpjsController
{
    protected $bpjs;

    public function __construct()
    {
        parent::__construct();
        $this->bpjs = new Bridging($this->consid, $this->timestamp, $this->signature);
    }

    public function CariSep($noSep)
    {
        $endpoint = "SEP/" . $noSep;
        $sep = $this->bpjs->getRequest($endpoint);
        return $sep;
    }

    public function  ajaxInsertSepBpjs(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['penjamin'] != 0) {
                $data['penjamin'] = implode(',', $data['penjamin']);
            }
            $data['ppk_pelayanan'] = '1105R001';
            $data['tgl_kejadian'] = date('Y-m-d', strtotime($data['tglKejadian']));
            $data['user'] = Auth::user()->name;

            if ($data['jns_pelayanan'] == "2") {
                $data['kelas_rawat'] = "3";
                $data['nama_kelas'] = getNamaKelas($data['kelas_rawat']);

                $message = [
                    'asal_pasien.required' => 'Asal pasien tidak boleh kosong!',
                    'nama_instansi.required' => 'Nama Instansi tidak boelh kosong!'
                ];

                $this->validate($request, [
                    'asal_pasien' => 'required',
                    'nama_instansi' => 'required'
                ], $message);
            }
        }
    }

    public function InsertSep($dataJson)
    {
        $endpoint = "SEP/1.1/insert";
        $sep = $this->bpjs->postRequest($endpoint, $dataJson);
        return $sep;
    }
}