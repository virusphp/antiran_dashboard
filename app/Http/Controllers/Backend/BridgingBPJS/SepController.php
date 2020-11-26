<?php

namespace App\Http\Controllers\Backend\BridgingBPJS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\Sep\Sep;

class SepController extends Controller
{
    protected $sep;

    public function __construct()
    {
        $this->sep = new sep();
    }

    public function  ajaxInsertSepBpjs(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['penjamin'] != 0) {
                $data['penjamin'] = implode(',', $data['penjamin']);
            }
            $data['ppk_pelayanan'] = '1105R001';
            $data['tgl_kejadian'] = date('Y-m-d', strtotime($data['tgl_kejadian']));
            $data['user'] = Auth::user()->name;

            if ($data['jns_pelayanan'] == "2") {
                $data['kelas_rawat'] = "3";
                $data['nama_kelas'] = getNamaKelas($data['kelas_rawat']);

                $message = [
                    'asal_pasien.required' => 'Asal pasien tidak boleh kosong!',
                    'nama_instansi.required' => 'Nama Instansi tidak boelh kosong!'
                ];

                $this->validate($request, [
                    'asal_pasien' => 'required',
                    'nama_instansi' => 'required'
                ], $message);
            }
            $data['nama_kelas'] = getNamaKelas($data['kelas_rawat']);
            $result = $this->sep->insertSep($data);
            return $result;
        }
    }

}