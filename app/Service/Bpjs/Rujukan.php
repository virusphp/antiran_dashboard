<?php

namespace App\Service\Bpjs;

class Rujukan extends ServiceBPJS
{
    protected $bpjs;

    public function __construct()
    {
        parent::__construct();
        $this->bpjs = new Bridging($this->consid, $this->timestamp, $this->signature);
    }

    public function getListRujukanPcare($params)
    {
        $endpoint = "Rujukan/List/Peserta/" . $params->no_kartu;
        $rujukanList = $this->bpjs->getRequest($endpoint);
        return $rujukanList;
    }

    public function getListRujukanRs($params)
    {
        $endpoint = "Rujukan/RS/List/Peserta/" . $params->no_kartu;
        $rujukanListRs = $this->bpjs->getRequest($endpoint);
        return $rujukanListRs;
    }

    public function getRujukanPcare($params)
    {
        $endpoint = "Rujukan/" . $params->no_rujukan;
        $rujukan = $this->bpjs->getRequest($endpoint);
        return $rujukan;
    }

    public function getRujukanRs($params)
    {
        $endpoint = "Rujukan/RS/" . $params->no_rujukan;
        $rujukan = $this->bpjs->getRequest($endpoint);
        return $rujukan;
    }

    public function insertRujukan($dataJson)
    {
        $endpoint = '/Rujukan/insert';
        $rujukan  = $this->bpjs->postRequest($endpoint, $dataJson);
        return $rujukan;
    }

}