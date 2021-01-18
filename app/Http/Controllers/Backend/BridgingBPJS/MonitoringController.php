<?php

namespace App\Http\Controllers\Backend\BridgingBPJS;

use App\Http\Controllers\Controller;
use App\Repository\Pasien\Pasien;
use App\Service\Bpjs\Peserta;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    protected $servicePeserta;
    protected $pasien;

    public function __construct()
    {
        $this->pasien = new Pasien;
        $this->servicePeserta = new Peserta;
    }

    public function ajaxHistoryPeserta(Request $request)
    {
        if ($request->ajax()) {
            $reqPasien = $this->pasien->getNomorKartu($request);
            $reqHistory = $this->servicePeserta->getHistoryPeserta($request, $reqPasien);
            $dataHistory = json_decode($reqHistory);
            $dataHistory->response->noKartu = $reqPasien->no_kartu;
            $dataHistory->response->noRm = $reqPasien->no_rm;
            $dataHistory->response->namaPeserta = $reqPasien->nama_pasien;
            return response()->json($dataHistory);
        }
    }

    public function Kunjungan($tglSep, $jnsPel)
    {
        $endpoint = "Monitoring/Kunjungan/Tanggal/" . $tglSep . "/jnsPelayanan/" . $jnsPel;
        $kunjungan = $this->bpjs->getRequest($endpoint);
        return $kunjungan;
    }

    public function Klaim($tglPulang, $jnsPel, $status)
    {
        $endpoint = "Monitoring/Klaim/Tanggal/" . $tglPulang . "/jnsPelayanan/" . $jnsPel . "/Status/" . $status;
        $klaim = $this->bpjs->getRequest($endpoint);
        return $klaim;
    }

    public function History($noKartu, $tglAwal, $tglAkhir)
    {
        $endpoint = "monitoring/HistoriPelayanan/NoKartu/" . $noKartu . "/tglAwal/" . $tglAwal . "/tglAkhir/" . $tglAkhir;
        $history = $this->bpjs->getRequest($endpoint);
        return $history;
    }

    public function JasaRaharja($tglAwal, $tglAkhir)
    {
        $endpoint = "monitoring/JasaRaharja/tglMulai/" . $tglAwal . "/tglAkhir/" . $tglAkhir;
        // dd($endpoint);
        $jasaRaharja = $this->bpjs->getRequest($endpoint);
        return $jasaRaharja;

    }
}