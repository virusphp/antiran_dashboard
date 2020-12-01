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

    public function getListSep($params)
    {
        $tglAwal = date_format(date_sub(date_create($params->tgl_akhir), date_interval_create_from_date_string('60 days')), 'Y-m-d');
        $endpoint = "monitoring/HistoriPelayanan/NoKartu/" . $params->no_kartu . '/tglAwal/'. $tglAwal . '/tglAkhir/'. $params->tgl_akhir;
        $listSep = $this->bpjs->getRequest($endpoint);
        return $listSep;
    }

    public function getSep($params)
    {
        $endpoint = "SEP/". $params->no_sep;
        $sep = $this->bpjs->getRequest($endpoint);
        return $sep;
    }

    public function InsertSep($dataJson)
    {
        $endpoint = "SEP/1.1/insert";
        $sep = $this->bpjs->postRequest($endpoint, $dataJson);
        return $sep;
    }
}