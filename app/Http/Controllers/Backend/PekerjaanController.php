<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController as Controller;
use App\Http\Requests\PekerjaanRequest;
use App\Models\Pekerjaan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bcrum = $this->bcrum('Jenis Pekerjaan');
        return view('backend.pekerjaan.create', compact('bcrum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PekerjaanRequest $request)
    {
        try {
            $data = $request->all();
            $newPekerjaan = Pekerjaan::create($data);
            if ($newPekerjaan) {
                $this->notification('success', 'Perhatian!', 'Pekerjaan berhasil dibuat!');
                return redirect()->route('pekerjaan.index');
            }
            throw new Exception('Gagal menyimpan pekerjaan dengan nama ' . $request->nama_pekerjaan, 1);
        } catch (Exception $e) {
            $this->notification('error', 'Peringatan!', $e->getMessage());
            return redirect()->back();
        }
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
        $bcrum = $this->bcrum('edit', route('pekerjaan.index'), 'Data Pekerjaan');
        $dataPekerjaan = Pekerjaan::find($id);

        return view('backend.pekerjaan.edit', compact('bcrum', 'dataPekerjaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PekerjaanRequest $request, $id)
    {
        try {
            $data = $request->all();
            $dataPekerjaan = Pekerjaan::find($id);
            $updatePekerjaan = $dataPekerjaan->update($data);

            if ($updatePekerjaan) {
                $this->notification('success', 'Perhatian!', 'Pekerjaan ' . $request->nama_pekerjaan . ' berhasil diubah!');
                return redirect()->route('pekerjaan.index');
            }
            throw new Exception('Gagal mengubah pekerjaan dengan nama ' . $request->nama_pekerjaan, 1);
        } catch (Exception $e) {

            $this->notification('error', 'Peringatan!', $e->getMessage());
            return redirect()->back();
        }
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
}
