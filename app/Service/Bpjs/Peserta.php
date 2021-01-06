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
}