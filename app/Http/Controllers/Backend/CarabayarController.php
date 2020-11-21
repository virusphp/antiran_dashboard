<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\Carabayar\Carabayar;

class CarabayarController extends Controller
{
    protected $carabayar;
    
    public function __construct()
    {
        $this->carabayar = new Carabayar;
    }

    public function ajaxListCarabayar()
    {
        $dataCarabayar = $this->carabayar->getCarabayar(); 
        return response()->json($dataCarabayar);
    }
}
