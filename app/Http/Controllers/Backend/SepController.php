<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\Sep\Sep;
use Illuminate\Http\Request;

class SepController extends Controller
{
    protected $sep;
    
    public function __construct()
    {
        $this->sep = new Sep;
    }

    public function ajaxEditSep(Request $request)
    {
        if ($request->ajax()) {
            $dataSep = $this->sep->getSep($request); 
            return response()->json($dataSep);
        }
    }
}
