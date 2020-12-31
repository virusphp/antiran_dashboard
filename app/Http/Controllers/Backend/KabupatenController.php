<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\Kabupaten\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    protected $kabupaten;
    
    public function __construct()
    {
        $this->kabupaten = new Kabupaten;
    }

    public function ajaxListKabupaten(Request $request)
    {
        if ($request->ajax()) {
            $dataKabupaten = $this->kabupaten->getKabupaten($request); 
            return response()->json($dataKabupaten);
        }
    }
}
