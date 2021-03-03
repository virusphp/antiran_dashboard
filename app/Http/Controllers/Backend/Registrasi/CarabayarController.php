<?php

namespace App\Http\Controllers\Backend\Registrasi;

use App\Http\Controllers\Controller;
use App\Repository\Carabayar\Carabayar;
use App\Transform\TransformCarabayar;
use Symfony\Component\HttpFoundation\Request;

class CarabayarController extends Controller
{
    protected $carabayar;
    protected $transform;
    
    public function __construct()
    {
        $this->carabayar = new Carabayar;
        $this->transform = new TransformCarabayar;
    }

    public function ajaxListCarabayar(Request $request)
    {
        if ($request->ajax()) {
            $carabayar = $this->carabayar->getCarabayar();
            
            if ($carabayar->count() == 0) {
                return response()->jsonApi(201, "Tidak ada penjamin");
            }

            $transform = $this->transform->mapCarabayar($carabayar);

            return response()->jsonApi(200, "OK", $transform);
        }
    }
}
