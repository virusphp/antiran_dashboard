<?php

namespace App\Http\Controllers\Backend;

use App\Repository\Pegawai\Pegawai;
use App\Repository\Registrasi\Registrasi;
use Illuminate\Http\Request;

class HomeController extends BackendController
{

    protected $registrasi;
    protected $pegawai;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->registrasi = new Registrasi;
        $this->pegawai = new Pegawai;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pegawaiUltah = $this->getUltahday();
        $registrasi = $this->getReportDay();
        $bcrum = $this->bcrum('Dashboard');
        return view('backend.home', compact('bcrum', 'pegawaiUltah', 'registrasi'));
    }

    private function getReportday()
    {
        return [
            "rawat_jalan" => $this->registrasi->getRegistrasiBpjs(1),
            "rawat_inap"  => $this->registrasi->getRegistrasiBpjs(2),
            "rawat_darurat" => $this->registrasi->getRegistrasiBpjs(3),
            "total" => $this->registrasi->getRegistrasiBpjs(1) + $this->registrasi->getRegistrasiBpjs(2) + $this->registrasi->getRegistrasiBpjs(3)
        ];
    }

    private function getUltahday()
    {
        $bulan = date('m');
        $hari = date('d');
        $pegawai = $this->pegawai->getUltahPegawai($hari, $bulan);

        if ($pegawai->count() != 0) {
            $dataPegawai = [];
            foreach ($pegawai as $key => $val) {
                $dataPegawai[$key] = $val;
                $dataPegawai[$key]->photo = "storage".DIRECTORY_SEPARATOR. $this->getPhoto($val->kd_pegawai, $val->foto);
                unset($val->foto);
            }
        } else {
            $dataPegawai = [];
        }

        return $dataPegawai;
    }
}
