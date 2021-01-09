<?php

namespace App\Http\Controllers\Backend;

use App\Repository\Registrasi\Registrasi;
use Illuminate\Http\Request;

class HomeController extends BackendController
{

    protected $registrasi;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->registrasi = new Registrasi;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $registrasi = $this->getReportDay();
        $bcrum = $this->bcrum('Dashboard');
        return view('backend.home', compact('bcrum', 'registrasi'));
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
}
