<?php

namespace App\Service\Bpjs;

class KetersediaanTT extends ServiceBPJS
{
    protected $signatureX;

    public function __construct()
    {
        parent::__construct();
        $this->signatureX = $this->signature;
        $this->bpjs = new Bridging($this->consid, $this->timestamp, $this->signatureX);
    }

    public function updateBed($kodePPK, $dataJson)
    {
        $endpoint = "rest/bed/update/". $kodePPK;
        $bed = $this->bpjs->postAplicareRequest($endpoint, $dataJson);
        return $bed;
    }

    public function createBed($kodePPK, $dataJson)
    {
        $endpoint = "rest/bed/create/". $kodePPK;
        $bed = $this->bpjs->postAplicareRequest($endpoint, $dataJson);
        return $bed;
    }
}