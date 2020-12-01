<?php

namespace App\Service\Bpjs;

class Referensi extends ServiceBPJS
{
    protected $bpjs;

    public function __construct()
    {
        parent::__construct();
        $this->bpjs = new Bridging($this->consid, $this->timestamp, $this->signature);
    }

    public function getPoli($params)
    {
        $endpoint = "referensi/poli/" . $params->term;
        $poli = $this->bpjs->getRequest($endpoint);
        return $poli;
    }

    public function getDiagnosa($params)
    {
        $endpoint = "referensi/diagnosa/". $params->term;
        $diagnosa = $this->bpjs->getRequest($endpoint);
        return $diagnosa;
    }

    public function getDpjp($params)
    {
        $tglSep = date('Y-m-d');
        $endpoint = "referensi/dokter/pelayanan/". $params->jns_pelayanan . "/tglPelayanan/". $tglSep . "/Spesialis/". $params->poli;
        $dpjp = $this->bpjs->getRequest($endpoint);
        return $dpjp;
    }
}