<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\Kecamatan\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    protected $kecamatan;

    public function __construct()
    {
        $this->kecamatan = new Kecamatan;
    }

    public function ajaxListKecamatan(Request $request)
    {
        if ($request->ajax()) {
            $dataKecamatan = $this->kecamatan->getKecamatan($request); 
            return response()->json($dataKecamatan);
        }
    }
}
