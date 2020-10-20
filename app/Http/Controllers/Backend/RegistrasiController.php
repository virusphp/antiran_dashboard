<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController as Controller;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

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

        return view('backend.registrasi.create',compact('bcrum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        if($request->ajax())
        {
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
                        'nama_pekerjaan' => '[' .$d->kode_pekerjaan. '] ' . $d->nama_pekerjaan
                    ];
                }
            }
            return response()->json($json);
        }
    }
}
