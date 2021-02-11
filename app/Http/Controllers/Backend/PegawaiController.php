<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\Pegawai\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    protected $pegawai;

    public function __construct()
    {
        $this->pegawai = new Pegawai;
    }

    public function ajaxListPegawai(Request $request)
    {
        if ($request->ajax()) {
            $request = $request->get('term');
            $pegawai = $this->pegawai->getList($request);
            $data = [];
            foreach($pegawai as $key => $val) {
                $foto = $this->getPhoto($val->kd_pegawai, $val->foto);
            }
        }
    }
}
