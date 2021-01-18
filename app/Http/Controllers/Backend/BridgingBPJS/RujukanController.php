<?php

namespace App\Http\Controllers\Backend\BridgingBPJS;

use App\Repository\Rujukan\Rujukan as AppRujukan;
use App\Service\Bpjs\Rujukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RujukanController extends BpjsController
{
    protected $service;
    protected $rujukan;

    public function __construct()
    {
        parent::__construct();
        $this->service = new Rujukan;
        $this->rujukan = new AppRujukan;
    }

    public function ajaxListRujukanBpjs(Request $request)
    {
        if ($request->ajax()) {
            $no = 1;
            $data = json_decode($this->service->getListRujukanPcare($request));
            if ($data->response == null) {
                $query = [];
            } else {
                foreach($data->response->rujukan as $val) {
                    $query[] = [
                        'no' => $no++,
                        'noKunjungan' => '
                            <div class="btn-group">
                                <button data-rujukan="'.$val->noKunjungan.'" id="h-rujukan" class="btn btn-sencodary btn-xs btn-cus">'.$val->noKunjungan.'</button>
                            </div> ',
                        'tglKunjungan' => $val->tglKunjungan,
                        'noKartu' => $val->peserta->noKartu,
                        'nama' => $val->peserta->nama,
                        'ppkPerujuk' => $val->provPerujuk->nama,
                        'pelayanan' => $val->pelayanan->nama,
                        'poli' => $val->poliRujukan->kode
                    ];
                }
            }
            $result = isset($query) ? ['data' => $query] : ['data' => 0];
            return json_encode($result);
        }
    }

    public function ajaxListRujukanRsBpjs(Request $request)
    {
        if ($request->ajax()) {
            $no = 1;
            $data = json_decode($this->service->getListRujukanRs($request));
            if ($data->response == null) {
                $query = [];
            } else {
                foreach($data->response->rujukan as $val) {
                    $query[] = [
                        'no' => $no++,
                        'noKunjungan' => '
                            <div class="btn-group">
                                <button data-rujukan="'.$val->noKunjungan.'" id="h-rujukan-rs" class="btn btn-sencodary btn-xs btn-cus">'.$val->noKunjungan.'</button>
                            </div> ',
                        'tglKunjungan' => $val->tglKunjungan,
                        'noKartu' => $val->peserta->noKartu,
                        'nama' => $val->peserta->nama,
                        'ppkPerujuk' => $val->provPerujuk->nama,
                        'pelayanan' => $val->pelayanan->nama,
                        'poli' => $val->poliRujukan->kode
                    ];
                }
            }
            $result = isset($query) ? ['data' => $query] : ['data' => 0];
            return json_encode($result);
        }
    }

    public function ajaxRujukanBpjs(Request $request)
    {
        if ($request->ajax()) {
            $rujukan = $this->service->getRujukanPcare($request);
            return $rujukan;
        }
    }

    public function ajaxRujukanRsBpjs(Request $request)
    {
        if ($request->ajax()) {
            $rujukan = $this->service->getRujukanRs($request);
            return $rujukan; 
        }
    }
  
    public function ajaxInsertRujukanBpjs(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $data['user'] = Auth::user()->nama_pegawai;
            $data['kode_asal_rujukan'] = getKodeAsalRujukan($data['no_sep']);
            $data['nama_asal_rujukan'] = "RSUD KRATON";
            $result = $this->rujukan->insertRujukan($data);
            return $result;
        }
    }
}