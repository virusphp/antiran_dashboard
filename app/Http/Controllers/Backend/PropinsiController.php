<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\Propinsi\Propinsi;
use Illuminate\Http\Request;

class PropinsiController extends Controller
{
    protected $propinsi;
    
    public function __construct()
    {
        $this->propinsi = new Propinsi;
    }

    public function ajaxListPropinsi()
    {
        $dataPropinsi = $this->propinsi->getPropinsi(); 
        return response()->json($dataPropinsi);
    }
}
