<?php

namespace App\Http\Controllers\Backend;

use App\Models\Divisi;
use Illuminate\Http\Request;
use Exception;
use DataTables;

class DivisiController extends BackendController
{
    public function index(Request $request)
    {
        $bcrum = $this->bcrum("Divisi");
        return view('backend.divisi.index', compact('bcrum'));
    }

    public function indexAjax(Request $request)
    {
        if ($request->ajax()) {
            // next masuk repository change to QUERY BUILDER
            $divisi = Divisi::select('id','kode_divisi','nama_divisi')
            ->where(function ($query) use ($request) {
                if ($term = $request->get('term')) {
                    $keywords = '%' . $term . '%';
                    $query->where('nama_divisi', 'like', $keywords);
                }
            })->latest();

            return DataTables::of($divisi)
                    ->setRowId('idx')
                    ->addIndexColumn()
                    ->addColumn('action', function($divisi) {
                        return view('datatables._action-divisi', [
                            'idx' => $divisi->id,
                            'nama_divisi' => $divisi->nama_divisi,
                            'edit_url' => route('divisi.edit', $divisi->id)
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
        $bcrum = $this->bcrum('Create', route('divisi.index'), 'Divisi');
        return view('backend.divisi.create', compact('bcrum'));
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

            $simpan = Divisi::create($input);
            if ($simpan) {
                $this->notification("success", "Informasi", $simpan->nama_divisi. " Berhasil di simpan!!");
                return redirect()->route('divisi.index');
            }
            throw new Exception("Gagal menyimpan data divisi!! dengan nama ", $input->nama_divisi);
        } catch (Exception $e) {
            $this->notification("error", "Gagal", "Terjadi Kesalahan ". $e->getMessage());
            return redirect()->route('divisi.index');
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
        $bcrum = $this->bcrum('Edit', route('divisi.index'), 'Divisi');

        $dataDivisi = Divisi::find($id);

        return view('backend.divisi.edit', compact('bcrum', 'dataDivisi'));
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
            $divisi = Divisi::find($id);
            $updateDivisi = $divisi->update($input);
            if ($updateDivisi) {
                $this->notification('success', 'Berhasil', 'Berhasil Ubah ' . $request->nama_divisi);
                return redirect()->route('divisi.index');
            }
            throw new Exception('Gagal Mengubah divisi ' . $request->nama_divisi);
        } catch (Exception $e) {
            $this->notification('error', 'Gagal', 'Terjadi kesalahan ' . $e->getMessage());
            dd($e->getMessage());
            return redirect()->route('divisi.index');
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
        $delete = Divisi::findOrFail($id);
        $delete->delete();
        if ($delete) {
            return response()->jsonSuccess(200, "Sukses Menghapus Kenangan", ['nama_divisi' => $delete->nama_divisi]);
        }
        return response()->jsonSuccess(201, "Gagal Menghapus Kenangan", ['nama_divisi' => $delete->nama_divisi]);
    }

    public function ajaxDestroy(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $delete = Divisi::findOrFail($input['idx']);
            $delete->delete();
            if ($delete) {
                return response()->jsonSuccess(200, "Sukses Menghapus data", ['nama_divisi' => $delete->nama_divisi]);
            }
            return response()->jsonSuccess(201, "Gagal Menghapus data", ['nama_divisi' => $delete->nama_divisi]);
        }
    }
}
