<?php

namespace App\Http\Controllers\Backend\Registrasi;

use App\Http\Controllers\Controller;
use App\Repository\Poliklinik\Poliklinik;
use App\Transform\TransformKlinik;
use Illuminate\Http\Request;

class PoliklinikController extends Controller
{
    protected $klinik;
    protected $transform;
    
    public function __construct()
    {
        $this->klinik = new Poliklinik;
        $this->transform = new TransformKlinik;
    }

    public function ajaxListKlinik(Request $request)
    {
        if ($request->ajax()) {

            $dataKlinikPengganti = $this->klinik->getPoliklinik();

            if ($dataKlinikPengganti->count() == 0) {
                return response()->jsonApi(201, "Tidak ada jadwal dokter");
            }

            $transform = $this->transform->mapKlinik($dataKlinikPengganti);

            return response()->jsonApi(200, "OK", $transform);
        }
    }
}
