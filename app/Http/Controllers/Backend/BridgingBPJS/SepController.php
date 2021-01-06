<?php

namespace App\Http\Controllers\Backend\BridgingBPJS;

use App\Http\Controllers\Controller;
use App\Http\Requests\SepInsert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\Sep\Sep;
use App\Service\Bpjs\Sep as AppSep;

class SepController extends Controller
{
    protected $sep;
    protected $service;

    public function __construct()
    {
        $this->sep = new sep;
        $this->service = new AppSep;
    }

    public function ajaxListSep(Request $request)
    {
        if ($request->ajax()) {
            $no = 1;
            $data = json_decode($this->service->getListSep($request));
            if ($data->response == null) {
                $query = [];
            } else {
                foreach($data->response->histori as $val) {
                    $query[] = [
                        'no' => $no++,
                        'noKunjungan' => '
                            <div class="btn-group">
                                <button data-rujukan="'.$val->noSep.'" data-faskes="'.$val->ppkPelayanan.'" data-jnspelayanan="'.$val->jnsPelayanan.'" id="h-sko" class="btn btn-sencodary btn-xs btn-cus">'.$val->noSep.'</button>
                            </div> ',
                        'tglKunjungan' => $val->tglSep,
                        'noKartu' => $val->noKartu,
                        'nama' => $val->namaPeserta,
                        'ppkPerujuk' => $val->ppkPelayanan,
                        'pelayanan' => jenisPelayanan($val->jnsPelayanan),
                        'poli' => $val->poli
                    ];
                }
            }
            $result = isset($query) ? ['data' => $query] : ['data' => 0];
            return json_encode($result);
        }
    }

    public function ajaxCariSep(Request $request)
    {
        if ($request->ajax()) {
            $sep = $this->service->getSep($request);
            return $sep;
        }
    }

    public function ajaxInsertSepBpjs(SepInsert $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['penjamin'] != 0) {
                $data['penjamin'] = implode(',', $data['penjamin']);
            }
            $data['ppk_pelayanan'] = '1105R001';
            $data['tgl_kejadian'] = date('Y-m-d', strtotime($data['tgl_kejadian']));
            $data['user'] = Auth::user()->nama_pegawai;

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

    public function ajaxUpdateSepBpjs(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['penjamin'] != 0) {
                $data['penjamin'] = implode(',', $data['penjamin']);
            }
            $data['ppk_pelayanan'] = '1105R001';
            $data['tgl_kejadian'] = date('Y-m-d', strtotime($data['tgl_kejadian']));
            $data['user'] = Auth::user()->nama_pegawai;

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
            $result = $this->sep->updateSep($data);
            return $result;
        }
    }

}