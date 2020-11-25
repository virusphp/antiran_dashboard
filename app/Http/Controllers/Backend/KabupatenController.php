<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    protected $kabupaten;
    
    public function __construct()
    {
        $this->kabupaten = new Kabupaten;
    }

    public function ajaxListKabupaten()
    {
        $dataKabupaten = $this->kabupaten->getKabupaten(); 
        return response()->json($dataKabupaten);
    }
}
