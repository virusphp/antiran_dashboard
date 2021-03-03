<?php

namespace App\Http\Controllers\Backend\Registrasi;

use App\Http\Controllers\Controller;
use App\Repository\Penjamin\Penjamin;
use App\Transform\TransformPenjamin;
use Illuminate\Http\Request;

class PenjaminController extends Controller
{
    protected $penjamin; 
    protected $transform; 

    public function __construct()
    {
        $this->penjamin = new Penjamin;
        $this->transform = new TransformPenjamin;
    }

    public function ajaxListPenjamin(Request $request)
    {
        if ($request->ajax()) {
            $penjamin = $this->penjamin->getListPenjamin($request);
            
            if ($penjamin->count() == 0) {
                return response()->jsonApi(201, "Tidak ada penjamin");
            }

            $transform = $this->transform->mapPenjamin($penjamin);

            return response()->jsonApi(200, "OK", $transform);
        }
    }
}
