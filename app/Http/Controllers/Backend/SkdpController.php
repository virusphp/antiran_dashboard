<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\Skdp\Skdp;
use Illuminate\Http\Request;

class SkdpController extends Controller
{
    protected $skdp;

    public function __construct()
    {
        $this->skdp = new Skdp;
    }

    public function ajaxListSkdp(Request $request)
    {
        if ($request->ajax()) {
            $no = 1;
            $data = $this->skdp->getNomorSurat($request); 
            foreach($data as $val) {
                $query[] = [
                    'no' => $no++,
                    'no_surat' => '
                        <div class="btn-group">
                            <button data-surat="'.noSurat($val->no_rujukan).'" id="h-no-surat" value="'.$val->kd_poli_dpjp.'" class="btn btn-sencodary btn-xs btn-cus">'.$val->no_rujukan.'</button>
                        </div> ',
                    'kd_poli_dpjp' => $val->kd_poli_dpjp,
                    'no_rujukan' => $val->no_rujukan_bpjs,
                    'jns_surat' => $val->jenis_surat,
                    'nama_dokter' => $val->nama_pegawai
                ];
            }
            $result = isset($query) ? ['data' => $query] : ['data' => 0];
            // dd($result);
            return json_encode($result);
        }
    }
}
