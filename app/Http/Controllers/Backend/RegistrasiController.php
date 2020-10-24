<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController as Controller;
use App\Http\Requests\RegistrasiRequest;
use App\Models\Client;
use App\Models\Pekerjaan;
use App\Models\ProsesPekerjaan;
use App\Models\RegistrasiDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $data = $this->handleRequest($request);

        DB::beginTransaction();
        try {
            $dataRegistrasiDetails = $this->handleRequestDetail($request->details);
            $newClient             = Client::create($data['client']);
            $newRegistrasi         = $newClient->registrasis()->create($data['registrasi']);
            $newRegistrasiDetails  = $newRegistrasi->details()->saveMany($dataRegistrasiDetails);
            $newTagihan            = $newRegistrasi->tagihans()->create($data['tagihan']);
            if ($data['kwitansi'] !== null) {
                $newKwitansi = $newTagihan->kwitansis()->create($data['kwitansi']);
            }
            DB::commit();
            return response()->json(['ok' => true, 'message' => 'Data Registrasi Berhasil Disimpan'], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['ok' => false, 'errors' => $e->getMessage()], 500);
        }
        //
    }


    public function getKodePembayaran()
    {
        // todo mendapatkan kode pembayaran yang valuenya proses

        return 1234;
    }

    //return array data
    public function handleRequest($request)
    {
        $data['client'] =
            [
                'nama_client' => $request->nama_client,
                'alamat_client' => $request->alamat_client,
                'no_telepon' => $request->no_telepon,
                'npwp_client' => $request->npwp_client,
            ];

        $data['registrasi'] =
            [
                'kode_pekerjaan' => $request->kode_pekerjaan,
                'no_akta' => $request->no_akta,
                'lokasi_akta' => $request->lokasi_akta,
                'tanggal_registrasi' => Carbon::now(),
                'user_id' => $request->user()->id,
            ];

        $data['tagihan'] =
            [
                'total_biaya_proses' => $request->total_biaya_proses,
                'total_biaya_pajak' => $request->total_biaya_pajak || 0,
                'keterangan' => $request->keterangan,
                'tanggal_tagihan' => Carbon::now(),
                'user_id' => $request->user()->id,
            ];

        if ($request->has('jumlah_bayar')) {

            if ($request->jumlah_bayar > 0) {
                $data['kwitansi'] =
                    [
                        'kode_pembayaran' => $this->getKodePembayaran(),
                        'no_referensi' => $request->no_referensi,
                        'jumlah_bayar' => $request->jumlah_bayar,
                        'tanggal_kwitansi' => Carbon::now(),
                        'user_id' => $request->user()->id,
                    ];
            } else {
                $data['kwitansi'] = null;
            }
        }
        // dd($data);
        return $data;
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
