<?php

namespace App\Http\Controllers\Backend\BridgingBPJS;

use App\Service\Bpjs\Bridging;
use Illuminate\Http\Request;

class RujukanController extends BpjsController
{
    protected $bpjs;

    public function __construct()
    {
        parent::__construct();
        $this->bpjs = new Bridging($this->consid, $this->timestamp, $this->signature);
    }

    public function ajaxListRujukanBpjs(Request $request)
    {
        if ($request->ajax()) {
            $no = 1;
            $data = json_decode($this->getListRujukan($request));
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

    public function getListRujukan($params)
    {
        $endpoint = "Rujukan/List/Peserta/" . $params->no_kartu;
        $rujukanList = $this->bpjs->getRequest($endpoint);
        return $rujukanList;
    }

    public function ajaxRujukanBpjs(Request $request)
    {
        if ($request->ajax()) {
            $endpoint = "Rujukan/" . $request->no_rujukan;
            $rujukan = $this->bpjs->getRequest($endpoint);
            return $rujukan;
        }
    }

    public function RujukanPcare($noRujukan)
    {
        $endpoint = "Rujukan/" . $noRujukan;
        $rujukan = $this->bpjs->getRequest($endpoint);
        return $rujukan;
    }

    public function RujukanRs($noRujukan)
    {
        $endpoint = "Rujukan/RS/" . $noRujukan;
        $rujukanRs = $this->bpjs->getRequest($endpoint);
        return $rujukanRs;
    }

    public function PesertaPcare($noKartu)
    {
        $endpoint = "Rujukan/Peserta/" . $noKartu;
        $rujukanPeserta = $this->bpjs->getRequest($endpoint);
        return $rujukanPeserta;
    }

    public function PesertaRs($noKartu)
    {
        $endpoint = "Rujukan/RS/Peserta/" . $noKartu;
        $rujukanPesertaRs = $this->bpjs->getRequest($endpoint);
        return $rujukanPesertaRs;
    }



    public function PesertaListRs($noKartu)
    {
        $endpoint = "Rujukan/RS/List/Peserta/" . $noKartu;
        $rujukanListRs = $this->bpjs->getRequest($endpoint);
        return $rujukanListRs;
    }
}