<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\Asalpasien\Asalpasien;

class AsalPasienController extends Controller
{
    protected $asalpasien;
    
    public function __construct()
    {
        $this->asalpasien = new Asalpasien;
    }

    public function ajaxListAsalpasien()
    {
        $dataAsalpasien = $this->asalpasien->getAsalPasien(); 
        return response()->json($dataAsalpasien);
    }
}
