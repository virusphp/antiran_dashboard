<?php

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Backend\BackendController as Controller;
use Illuminate\Http\Request;
// use App\Models\Pasien;
use App\Repository\Pasien\Pasien;
use DataTables;

class PasienController extends Controller
{
    protected $pasien;

    public function __construct()
    {
        $this->pasien = new Pasien;
    }

    public function index(Request $request)
    {
        $bcrum = $this->bcrum("Pasien");
        return view('backend.pasien.index', compact('bcrum'));
    }

    public function indexAjax(Request $request)
    {
        if ($request->ajax()) {
            // next masuk repository change to QUERY BUILDER
            $pasien = $this->pasien->getPasien($request); 
            // dd($pasien);

            return DataTables::of($pasien)
                    ->setRowId('idx')
                    ->addIndexColumn()
                    ->editColumn('jns_kel', function($pasien){
                        return jenisKelamin($pasien->jns_kel);
                    })
                    ->editColumn('tgl_lahir', function($pasien){
                        return tanggalLahir($pasien->tgl_lahir);
                    })
                    ->addColumn('action', function($pasien) {
                        return view('datatables._action-pasien', [
                            'idx' => $pasien->no_rm,
                            'nama_pasien' => $pasien->nama_pasien,
                            'edit_url' => route('pasien.edit', $pasien->no_rm)
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
        $bcrum = $this->bcrum('Create', route('pasien.index'), 'Pasien');
        return view('backend.pasien.create', compact('bcrum'));
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

            $simpan = Pasien::create($input);
            if ($simpan) {
                $this->notification("success", "Informasi", $simpan->nama_pasien. " Berhasil di simpan!!");
                return redirect()->route('pasien.index');
            }
            throw new Exception("Gagal menyimpan data pasien!! dengan nama ", $input->nama_pasien);
        } catch (Exception $e) {
            $this->notification("error", "Gagal", "Terjadi Kesalahan ". $e->getMessage());
            return redirect()->route('pasien.index');
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
        $bcrum = $this->bcrum('Edit', route('pasien.index'), 'Pasien');

        $dataPasien = $this->pasien->getPasienEdit($id);

        return view('backend.pasien.edit', compact('bcrum', 'dataPasien'));
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
            $pasien = Pasien::find($id);
            $updatePasien = $pasien->update($input);
            if ($updatePasien) {
                $this->notification('success', 'Berhasil', 'Berhasil Ubah ' . $request->nama_pasien);
                return redirect()->route('pasien.index');
            }
            throw new Exception('Gagal Mengubah pasien ' . $request->nama_pasien);
        } catch (Exception $e) {
            $this->notification('error', 'Gagal', 'Terjadi kesalahan ' . $e->getMessage());
            dd($e->getMessage());
            return redirect()->route('pasien.index');
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
        $delete = Pasien::findOrFail($id);
        $delete->delete();
        if ($delete) {
            return response()->jsonSuccess(200, "Sukses Menghapus Kenangan", ['nama_pasien' => $delete->nama_pasien]);
        }
        return response()->jsonSuccess(201, "Gagal Menghapus Kenangan", ['nama_pasien' => $delete->nama_pasien]);
    }

    public function ajaxDestroy(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $delete = Pasien::findOrFail($input['idx']);
            $delete->delete();
            if ($delete) {
                return response()->jsonSuccess(200, "Sukses Menghapus data", ['nama_pasien' => $delete->nama_pasien]);
            }
            return response()->jsonSuccess(201, "Gagal Menghapus data", ['nama_pasien' => $delete->nama_pasien]);
        }
    }
}