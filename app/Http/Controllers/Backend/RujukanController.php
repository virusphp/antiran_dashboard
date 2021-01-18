<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController as Controller;
use App\Repository\Rujukan\Rujukan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RujukanController extends Controller
{
    protected $rujukan;
    
    public function __construct()
    {
        $this->rujukan = new Rujukan;
    }

    public function index()
    {
        $bcrum = $this->bcrum('Rujukan');
        return view('backend.rujukan.index', compact('bcrum'));
    }

    public function indexAjax(Request $request)
    {
        if ($request->ajax()) {
            $rujukan = $this->rujukan->getRujukan($request);
            // dd($rujukan);
            return DataTables::of($rujukan)
                ->setRowId('idx')
                ->addIndexColumn()
                ->addColumn('no_rujukan',function($rujukan){
                    return $rujukan->no_rujukan;
                })
                ->addColumn('action', function ($rujukan) {
                    return view('datatables._action-rujukan', [
                        'no_rujukan' => $rujukan->no_rujukan,
                        'no_sep' => $rujukan->no_sep, // nomor sep
                        'edit_url' => route('rujukan.edit')
                    ]);
                })
                ->make(true);
        }
    }


    public function ajaxRujukanInternal(Request $request)
    {
        if ($request->ajax()) {
            $dataRujukan = $this->rujukan->getRujukanInternal($request); 
            return response()->json($dataRujukan);
        }
    }

    public function printRujukan($noRujukan)
    {
        $dataRujukan = $this->rujukan->getRujukanKeluar($noRujukan);
        return view('print.cetak-rujukan', compact('dataRujukan'));
    }
}
