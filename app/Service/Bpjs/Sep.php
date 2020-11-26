<?php

namespace App\Service\Bpjs;

class Sep extends ServiceBPJS
{
    protected $bpjs;

    public function __construct()
    {
        parent::__construct();
        $this->bpjs = new Bridging($this->consid, $this->timestamp, $this->signature);
    }

    public function InsertSep($dataJson)
    {
        $endpoint = "SEP/1.1/insert";
        $sep = $this->bpjs->postRequest($endpoint, $dataJson);
        return $sep;
    }
}