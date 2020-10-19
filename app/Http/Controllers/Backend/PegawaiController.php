<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Divisi;
use Yajra\DataTables\DataTables;

class PegawaiController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bcrum = $this->bcrum("Pegawai");
        return view('backend.pegawai.index', compact('bcrum'));
    }

    public function indexAjax(Request $request)
    {
        if ($request->ajax()) {
            // next masuk repository change to QUERY BUILDER
            $pegawai = Pegawai::select('id','kode_pegawai','nama_pegawai','tempat_lahir','tanggal_lahir','jenis_kelamin', 'divisi_id')
            ->where(function ($query) use ($request) {
                if ($term = $request->get('term')) {
                    $keywords = '%' . $term . '%';
                    $query->where('nama_pegawai', 'like', $keywords);
                }
            })->latest();

            return DataTables::of($pegawai)
                    ->setRowId('idx')
                    ->addIndexColumn()
                    ->editColumn('divisi_id', function($pegawai){
                        return $pegawai->divisi->nama_divisi;
                    })
                    ->editColumn('tanggal_lahir', function($pegawai){
                        return tanggalLahir($pegawai->tanggal_lahir);
                    })
                    ->editColumn('jenis_kelamin', function($pegawai){
                        return jenisKelamin($pegawai->jenis_kelamin);
                    })
                    ->addColumn('action', function($pegawai) {
                        return view('datatables._action-pegawai', [
                            'idx' => $pegawai->id,
                            'nama_pegawai' => $pegawai->nama_pegawai,
                            'edit_url' => route('pegawai.edit', $pegawai->id)
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
        $bcrum = $this->bcrum('Create', route('pegawai.index'), 'Pegawai');
        $divisi = Divisi::pluck('nama_divisi','id');
        return view('backend.pegawai.create', compact('bcrum','divisi'));
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

            $simpan = Pegawai::create($input);
            if ($simpan) {
                $this->notification("success", "Informasi", $simpan->nama_pegawai. " Berhasil di simpan!!");
                return redirect()->route('pegawai.index');
            }
            throw new Exception("Gagal menyimpan data divisi!! dengan nama ", $input->nama_pegawai);
        } catch (Exception $e) {
            $this->notification("error", "Gagal", "Terjadi Kesalahan ". $e->getMessage());
            return redirect()->route('pegawai.index');
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
        $bcrum = $this->bcrum('Edit', route('pegawai.index'), 'Pegawai');

        $dataPegawai = Pegawai::find($id);
        $divisi = Divisi::pluck('nama_divisi','id');
        return view('backend.pegawai.edit', compact('bcrum','divisi','dataPegawai'));
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
            $pegawai = Pegawai::find($id);
            $updatePegawai = $pegawai->update($input);
            if ($updatePegawai) {
                $this->notification('success', 'Berhasil', 'Berhasil Ubah ' . $request->nama_pegawai);
                return redirect()->route('pegawai.index');
            }
            throw new Exception('Gagal Mengubah divisi ' . $request->nama_pegawai);
        } catch (Exception $e) {
            $this->notification('error', 'Gagal', 'Terjadi kesalahan ' . $e->getMessage());
            return redirect()->route('pegawai.index');
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
        
    }

    public function ajaxDestroy(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $delete = Pegawai::findOrFail($input['idx']);
            $delete->delete();
            if ($delete) {
                return response()->jsonSuccess(200, "Sukses Menghapus Data", ['nama_pegawai' => $delete->nama_pegawai]);
            }
            return response()->jsonSuccess(201, "Gagal Menghapus Data", ['nama_divisi' => $delete->nama_pegawai]);
        }
    }
}
