<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\Rujukan\Rujukan;
use Illuminate\Http\Request;

class RujukanController extends Controller
{
    protected $rujukan;
    
    public function __construct()
    {
        $this->rujukan = new Rujukan;
    }

    public function ajaxRujukanInternal(Request $request)
    {
        if ($request->ajax()) {
            $dataRujukan = $this->rujukan->getRujukanInternal($request); 
            return response()->json($dataRujukan);
        }
    }
}
