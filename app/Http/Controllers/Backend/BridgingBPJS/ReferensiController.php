<?php

namespace App\Http\Controllers\Backend\BridgingBPJS;

use App\Service\Bpjs\Bridging;
use App\Service\Bpjs\Referensi;
use Illuminate\Http\Request;

class ReferensiController extends BpjsController
{
    protected $referensi;

    public function __construct()
    {
        $this->referensi = new Referensi();
    }

    public function diagnosa($kode)
    {
        $endpoint = "referensi/diagnosa/". $kode;
        $diagnosa = $this->bpjs->getRequest($endpoint);
        return $diagnosa;
    }

    public function ajaxListPoli(Request $request)
    {
        if ($request->ajax()) {
            $poli = $this->referensi->getPoli($request);
            return $poli;
        }
    }

    public function faskes($kodeNama, $jenisFaskes)
    {
        $endpoint = "referensi/faskes/" . $kodeNama . "/" . $jenisFaskes;
        $faskes = $this->bpjs->getRequest($endpoint);
        return $faskes;
    }

    public function dpjp($jnsPel, $tglPel, $subSpesial)
    {
        $endpoint = "referensi/dokter/pelayanan/" . $jnsPel . "/tglPelayanan/" . $tglPel. "/Spesialis/". $subSpesial;
        $dpjp = $this->bpjs->getRequest($endpoint);
        return $dpjp;
    }

    public function propinsi()
    {
        $endpoint = "referensi/propinsi";
        $propinsi = $this->bpjs->getRequest($endpoint);
        return $propinsi;
    }

    public function kabupaten($kodePropinsi)
    {
        $endpoint = "referensi/kabupaten/propinsi/" . $kodePropinsi;
        $kabupaten = $this->bpjs->getRequest($endpoint);
        return $kabupaten;
    }

    public function kecamatan($kodeKabupaten)
    {
        $endpoint = "referensi/kecamatan/kabupaten/" . $kodeKabupaten;
        $kecamatan = $this->bpjs->getRequest($endpoint);
        return $kecamatan;
    }

    public function procedure($kodeNama)
    {
        $endpoint = "referensi/procedure/" . $kodeNama;
        $procedure = $this->bpjs->getRequest($endpoint);
        return $procedure;
    }

    public function kelas()
    {
        $endpoint = "referensi/kelasrawat";
        $kelas = $this->bpjs->getRequest($endpoint);
        return $kelas;
    }

    public function dokter($namaDokter)
    {
        $endpoint = "referensi/dokter/". $namaDokter;
        $dokter = $this->bpjs->getRequest($endpoint);
        return $dokter;
    }

    public function spesialistik()
    {
        $endpoint = "referensi/spesialistik";
        $spesialistik = $this->bpjs->getRequest($endpoint);
        return $spesialistik;
    }

    public function ruang()
    {
        $endpoint = "referensi/ruangrawat";
        $ruang = $this->bpjs->getRequest($endpoint);
        return $ruang;
    }

    public function caraKeluar()
    {
        $endpoint = "referensi/carakeluar";
        $caraKeluar = $this->bpjs->getRequest($endpoint);
        return $caraKeluar;
    }

    public function pascaPulang()
    {
        $endpoint = "referensi/pascapulang";
        $pascaPulang = $this->bpjs->getRequest($endpoint);
        return $pascaPulang;
    }

}