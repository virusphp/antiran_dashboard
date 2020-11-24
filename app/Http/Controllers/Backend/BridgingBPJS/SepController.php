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
            dd($request->all());
        }
    }

    public function InsertSep($dataJson)
    {
        $endpoint = "SEP/1.1/insert";
        $sep = $this->bpjs->postRequest($endpoint, $dataJson);
        return $sep;
    }
}