<?php

namespace App\Http\Controllers\Backend\BridgingBPJS;

use App\Service\Bpjs\Rujukan;
use Illuminate\Http\Request;

class RujukanController extends BpjsController
{
    protected $rujukan;

    public function __construct()
    {
        parent::__construct();
        $this->rujukan = new Rujukan();
    }

    public function ajaxListRujukanBpjs(Request $request)
    {
        if ($request->ajax()) {
            $no = 1;
            $data = json_decode($this->rujukan->getListRujukanPcare($request));
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
            $data = json_decode($this->rujukan->getListRujukanRs($request));
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
            $rujukan = $this->rujukan->getRujukanPcare($request);
            return $rujukan;
        }
    }

    public function ajaxRujukanRsBpjs(Request $request)
    {
        if ($request->ajax()) {
            $rujukan = $this->rujukan->getRujukanRs($request);
            return $rujukan; 
        }
    }
  
}