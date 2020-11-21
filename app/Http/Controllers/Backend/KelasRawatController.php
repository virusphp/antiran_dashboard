<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelasRawatController extends Controller
{
    public function ajaxListKelas()
    {
        $dataKelas = namaKelas();
        return response()->json($dataKelas);
    }
}
