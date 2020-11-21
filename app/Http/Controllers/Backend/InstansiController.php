<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\Instansi\Instansi;

class InstansiController extends Controller
{
    protected $instansi;
    
    public function __construct()
    {
        $this->instansi = new Instansi;
    }

    public function ajaxListInstansi()
    {
        $dataInstansi = $this->instansi->getInstansi(); 
        return response()->json($dataInstansi);
    }
}
