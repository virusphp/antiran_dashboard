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
}