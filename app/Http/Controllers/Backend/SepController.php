<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\Registrasi\Registrasi;
use App\Repository\Sep\Sep;
use App\Service\Bpjs\Peserta;
use App\Service\Bpjs\Sep as AppSep;
use Illuminate\Http\Request;

class SepController extends Controller
{
    protected $sep;
    protected $registrasi;
    protected $serviceSep;
    protected $servicePeserta;
    
    public function __construct()
    {
        $this->sep = new Sep;
        $this->registrasi = new Registrasi;
        $this->serviceSep = new AppSep;
        $this->servicePeserta = new Peserta;
    }

    public function ajaxEditSep(Request $request)
    {
        if ($request->ajax()) {
            $dataSep = $this->sep->getSep($request); 
            return response()->json($dataSep);
        }
    }

    public function printSep($noReg)
    {
        $dataRegistrasi = $this->registrasi->getRegistrasiPasien($noReg);
        $dataRegistrasi->alamat = $dataRegistrasi->alamat.' Kel.'.$dataRegistrasi->nama_kelurahan.' Kec.'.$dataRegistrasi->nama_kecamatan.' Kab.'.$dataRegistrasi->nama_kabupaten.' Prov.'.$dataRegistrasi->nama_propinsi;
        if (noReg($noReg) == "02") {
            $dataRegistrasi->nama_poli = "-";
            $dataRegistrasi->antrian = "-";
        } else if (noReg($noReg) == "03") {
            $dataRegistrasi->nama_poli = "INSTALASI GAWAT DARURAT";
            $dataRegistrasi->antrian = "-";
        } else {
            $dataPoli = $this->registrasi->getRawatJalanDetail($noReg);
            $datAntrian = $this->registrasi->getRegistrasiAntrian($dataPoli);
            $dataRegistrasi->nama_poli = $dataPoli->nama_poliklinik;
            $dataRegistrasi->antrian = isset($datAntrian) != null ? $datAntrian[0]->noantrian : "-";
        }
        $req = $this->serviceSep->getSep($dataRegistrasi);
        unset($dataRegistrasi->nama_kecamatan,$dataRegistrasi->nama_kelurahan,$dataRegistrasi->nama_kabupaten, $antrian, $dataRegistrasi->nama_propinsi,$dataRegistrasi->tgl_reg, $dataRegistrasi->kd_poliklinik,$dataRegistrasi->no_sep);
        $jsonSep = json_decode($req);
        $dataSep = $jsonSep->response;
        $reqPeserta = $this->servicePeserta->getPeserta($dataSep->peserta->noKartu, $dataSep->tglSep);
        $jsonPeserta = json_decode($reqPeserta);
        $dataPeserta = $jsonPeserta->response->peserta->informasi;

        // SET SEP
        $dataSep->alamat = $dataRegistrasi->alamat;
        $dataSep->nama_poli = $dataRegistrasi->nama_poli;
        $dataSep->antrian = $dataRegistrasi->antrian;
        $dataSep->asal_faskes = $jsonPeserta->response->peserta->provUmum->nmProvider;
        $dataSep->no_reg = $dataRegistrasi->no_reg;
        // dd($dataSep);

        return view('print.cetak-sep', compact('dataSep', 'dataPeserta'));
    }

}
