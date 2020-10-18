<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProsesPekerjaan;
use Illuminate\Http\Request;
use Exception;
use DataTables;

class ProsesPekerjaanController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bcrum = $this->bcrum("Proses Pekerjaan");
        return view('backend.proses.index', compact('bcrum'));
    }

    public function indexAjax(Request $request)
    {
        if ($request->ajax()) {
            // next masuk repository change to QUERY BUILDER
            $proses = ProsesPekerjaan::where(function ($query) use ($request) {
                if ($term = $request->get('term')) {
                    $keywords = '%' . $term . '%';
                    $query->where('nama_proses', 'like', $keywords);
                }
            })->latest();
            return DataTables::of($proses)
                ->setRowId('idx')
                ->addIndexColumn()
                ->editColumn('status_proses', function ($proses) {
                    return statusPekerjaan($proses->status_proses);
                })
                ->addColumn('action', function ($proses) {
                    return view('datatables._action-proses', [
                        'idx' => $proses->id,
                        'nama_proses' => $proses->nama_proses,
                        'edit_url' => route('proses.edit', $proses->id)
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
        $bcrum = $this->bcrum('Create', route('proses.index'), 'Proses Pekerjaan');
        return view('backend.proses.create', compact('bcrum'));
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
            $simpan = ProsesPekerjaan::create($input);
            if ($simpan) {
                $this->notification("success", "informasi", $simpan->nama_proses . " Berhasil disimpan");
                return redirect()->route('proses.index');
            }
            throw new Exception($input->nama_proses . " Gagal disimpan!");
        } catch (Exception $ex) {
            $this->notification("error", "Gagal", "Terjadi Kesalahan " . $ex->getMessage());
            return redirect()->route("proses.index");
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
}
