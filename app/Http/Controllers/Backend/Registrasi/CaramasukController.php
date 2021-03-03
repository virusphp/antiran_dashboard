<?php

namespace App\Http\Controllers\Backend\Registrasi;

use App\Http\Controllers\Controller;
use App\Repository\Caramasuk\Caramasuk;
use App\Transform\TransformCaramasuk;
use Illuminate\Http\Request;

class CaramasukController extends Controller
{
    protected $caramasuk; 
    protected $transform; 

    public function __construct()
    {
        $this->caramasuk = new Caramasuk;
        $this->transform = new TransformCaramasuk;
    }

    public function ajaxListCaraMasuk(Request $request)
    {
        if ($request->ajax()) {
            $penjamin = $this->caramasuk->getListCaramasuk();
            
            if ($penjamin->count() == 0) {
                return response()->jsonApi(201, "Tidak ada penjamin");
            }

            $transform = $this->transform->mapCaramasuk($penjamin);

            return response()->jsonApi(200, "OK", $transform);
        }
    }
}
