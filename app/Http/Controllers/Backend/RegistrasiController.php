<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController as Controller;
use App\Http\Requests\RegistrasiRequest;
use App\Models\Pekerjaan;
use App\Models\ProsesPekerjaan;
use App\Models\RegistrasiDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bcrum = $this->bcrum('Registrasi');
        return view('backend.registrasi.index', compact('bcrum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bcrum = $this->bcrum('Registrasi Client');

        return view('backend.registrasi.create', compact('bcrum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistrasiRequest $request)
    {
        try {
            // $data = $request->all();
            DB::beginTransaction();
            $dataClient =
                [
                    'nama_client' => $request->nama_client,
                    'alamat_client' => $request->alamat_client,
                    'no_telepon' => $request->no_telepon,
                    'npwp_client' => $request->npwp_client,
                ];

            $newClient = $request->user()->clients()->create($dataClient);

            $dataRegistrasi =
                [
                    'kode_pekerjaan' => $request->kode_pekerjaan,
                    'no_akta' => $request->no_akta,
                    'lokasi_akta' => $request->lokasi_akta,
                ];


            $dataRegistrasiDetails = $this->handleRequestDetail($request->details);
            $newRegistrasi         = $newClient->registrasis()->create($dataRegistrasi);
            $newRegistrasiDetails  = $newRegistrasi->details()->saveMany($dataRegistrasiDetails);

            $dataTagihan =
                [
                    'total_biaya_proses' => $request->total_biaya_proses,
                    'total_biaya_pajak' => $request->total_biaya_pajak,
                    'keterangan' => $request->keterangan,
                ];

            $newTagihan        = $newRegistrasi->tagihans()->create($dataTagihan);


            if ($request->has('total_bayar')) {

                if ($request->total_bayar > 0) {
                    $dataKwitansi =
                        [
                            'kode_pembayaran' => $this->getKodePembayaran(),
                            'no_referensi' => $request->no_referensi,
                            'jumlah_bayar' => $request->total_bayar,
                        ];

                        $newKwitansi = $newTagihan->kwitansis()->create($dataKwitansi);
                }
            }
        } catch (Exception $e) {
            //throw $th;



        }
        //
    }


    public function getKodePembayaran()
    {
        // todo mendapatkan kode pembayaran yang valuenya proses

        return 1234;
    }

    public function handleRequestDetail($details)
    {
        $data = [];
        foreach ($details as $detail) {
            $data[] = new RegistrasiDetail($detail);
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cariPekerjaan(Request $request)
    {
        if ($request->ajax()) {
            $json = [];
            if ($request->has('q') && strlen($request->q) >= 3) {
                $data = Pekerjaan::select('kode_pekerjaan', 'nama_pekerjaan')
                    ->where(function ($query) use ($request) {
                        $keywords = '%' . $request->q . '%';
                        $query->where('kode_pekerjaan', 'like', $keywords)
                            ->orWhere('nama_pekerjaan', 'like', $keywords);
                    })
                    ->get();
                foreach ($data as $d) {
                    $json[] = [
                        'kode_pekerjaan' => $d->kode_pekerjaan,
                        'nama_pekerjaan' => '[' . $d->kode_pekerjaan . '] ' . $d->nama_pekerjaan
                    ];
                }
            }
            return response()->json($json);
        }
    }

    public function cariProses(Request $request)
    {
        if ($request->ajax()) {
            $json = [];
            if ($request->has('q') && strlen($request->q) >= 3) {
                $data = ProsesPekerjaan::select('kode_proses', 'nama_proses', 'waktu_proses')
                    ->where(function ($query) use ($request) {
                        $keywords = '%' . $request->q . '%';
                        $query->where('kode_proses', 'like', $keywords)
                            ->orWhere('nama_proses', 'like', $keywords);
                    })
                    ->get();
                foreach ($data as $d) {
                    $json[] = [
                        'kode_proses' => $d->kode_proses,
                        'nama_proses' => $d->nama_proses . ' (' . $d->waktu_proses . ' hari)',
                    ];
                }
            }
            return response()->json($json);
        }
    }
}
