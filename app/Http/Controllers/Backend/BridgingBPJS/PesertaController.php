<?php

namespace App\Http\Controllers\Backend\BridgingBPJS;

use App\Service\Bpjs\Bridging;
use Illuminate\Http\Request;

class PesertaController extends BpjsController
{
    protected $bpjs;

    public function __construct()
    {
        parent::__construct();
        $this->bpjs = new Bridging($this->consid, $this->timestamp, $this->signature);
    }

    public function ajaxPesertaBpjs(Request $request)
    {
        if ($request->ajax()) {
            $endpoint = 'Peserta/nokartu/'. $request->no_kartu . "/tglSEP/" . $request->tgl_reg;
            $peserta = $this->bpjs->getRequest($endpoint);
            return $peserta;
        }
       
    }

    public function noKtp($nik, $tglSep)
    {
        $endpoint = 'Peserta/nik/'. $nik . "/tglSEP/" . $tglSep;
        $peserta = $this->bpjs->getRequest($endpoint);
        return $peserta;
    }
}