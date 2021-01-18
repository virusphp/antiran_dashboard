<?php

namespace App\Service\Bpjs;

class Peserta extends ServiceBPJS
{
    protected $bpjs;

    public function __construct()
    {
        parent::__construct();
        $this->bpjs = new Bridging($this->consid, $this->timestamp, $this->signature);
    }

    public function getPeserta($noKartu, $tglSep)
    {
        $endpoint = "/Peserta/noKartu/". $noKartu . "/tglSEP/". $tglSep;
        $peserta = $this->bpjs->getRequest($endpoint);
        return $peserta;
    }

    public function getHistoryPeserta($params, $paramKartu)
    {
        $tglAwal = date_format(date_sub(date_create($params->tgl_akhir), date_interval_create_from_date_string('60 days')), 'Y-m-d');
        $endpoint = "/monitoring/HistoriPelayanan/NoKartu/". $paramKartu->no_kartu . "/tglAwal/". $tglAwal. "/tglAkhir/". $params->tgl_akhir;
        $peserta = $this->bpjs->getRequest($endpoint);
        return $peserta;
    }
}