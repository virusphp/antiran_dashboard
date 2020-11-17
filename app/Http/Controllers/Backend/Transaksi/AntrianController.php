<?php

namespace App\Http\Controllers\Backend\Transaksi;

use App\Http\Controllers\Backend\BackendController as Controller;
use Illuminate\Http\Request;
use App\Repository\Antrian;
use DataTables;

class AntrianController extends Controller
{
    protected $antrian;

    public function __construct()
    {
        $this->antrian = new Antrian;
    }
    public function index(Request $request)
    {
        $bcrum = $this->bcrum("Antrian");
        return view('backend.antrian.index', compact('bcrum'));
    }

    public function indexAjax(Request $request)
    {
        if ($request->ajax()) {
            // next masuk repository change to QUERY BUILDER
            $antrian = $this->antrian->getRekap($request);

            return DataTables::of($antrian)
                    ->setRowId('idx')
                    ->addIndexColumn()
                    ->editColumn('nama_poliklinik', function($antrian){
                        return $antrian->nama_sub_unit;
                    })
                    ->addColumn('action', function($antrian) {
                        return view('datatables._action-antrian', [
                            'idx' => $antrian->kd_poliklinik,
                            'nama_antrian' => $antrian->kd_poliklinik,
                            'edit_url' => route('antrian.showpoli', [$antrian->kd_poliklinik, tanggal($antrian->tgl_reg)])
                        ]);
                    })
                    ->make(true);
        }
       
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $bcrum = $this->bcrum('Create', route('antrian.index'), 'Antrian');
        return view('backend.antrian.create', compact('bcrum'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        try {
            $input = $request->all();

            $simpan = Antrian::create($input);
            if ($simpan) {
                $this->notification("success", "Informasi", $simpan->nama_antrian. " Berhasil di simpan!!");
                return redirect()->route('antrian.index');
            }
            throw new Exception("Gagal menyimpan data antrian!! dengan nama ", $input->nama_antrian);
        } catch (Exception $e) {
            $this->notification("error", "Gagal", "Terjadi Kesalahan ". $e->getMessage());
            return redirect()->route('antrian.index');
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
        dd($id);
    }

    public function showPoli($poli, $tanggal)
    {
        $bcrum = $this->bcrum('Antrian', route('antrian.index'), 'Tampil Antrian');
        return view('backend.antrian.show', compact('bcrum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bcrum = $this->bcrum('Edit', route('antrian.index'), 'Antrian');

        $dataAntrian = Antrian::find($id);

        return view('backend.antrian.edit', compact('bcrum', 'dataAntrian'));
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
        try {
            $input = $request->all();
            $antrian = Antrian::find($id);
            $updateAntrian = $antrian->update($input);
            if ($updateAntrian) {
                $this->notification('success', 'Berhasil', 'Berhasil Ubah ' . $request->nama_antrian);
                return redirect()->route('antrian.index');
            }
            throw new Exception('Gagal Mengubah antrian ' . $request->nama_antrian);
        } catch (Exception $e) {
            $this->notification('error', 'Gagal', 'Terjadi kesalahan ' . $e->getMessage());
            dd($e->getMessage());
            return redirect()->route('antrian.index');
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
        $delete = Antrian::findOrFail($id);
        $delete->delete();
        if ($delete) {
            return response()->jsonSuccess(200, "Sukses Menghapus Kenangan", ['nama_antrian' => $delete->nama_antrian]);
        }
        return response()->jsonSuccess(201, "Gagal Menghapus Kenangan", ['nama_antrian' => $delete->nama_antrian]);
    }

    public function ajaxDestroy(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $delete = Antrian::findOrFail($input['idx']);
            $delete->delete();
            if ($delete) {
                return response()->jsonSuccess(200, "Sukses Menghapus data", ['nama_antrian' => $delete->nama_antrian]);
            }
            return response()->jsonSuccess(201, "Gagal Menghapus data", ['nama_antrian' => $delete->nama_antrian]);
        }
    }
}