<?php

namespace App\Http\Controllers\Backend;

use App\Models\Client;
use Illuminate\Http\Request;
use Exception;

class ClientController extends BackendController
{
    public function index(Request $request)
    {
        $bcrum = $this->bcrum("Client");
        $client = Client::where(function ($query) use ($request) {
            if ($term = $request->get('term')) {
                $keywords = '%' . $term . '%';
                $query->where('nama', 'like', $keywords);
            }
        })->latest()->paginate($this->limit);
        return view('backend.client.index', compact('bcrum', 'client'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $bcrum = $this->bcrum('Create', route('client.index'), 'Client');
        return view('backend.client.create', compact('bcrum'));
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
            $simpan = Client::create($input);
            if ($simpan) {
                $this->notification("success", "Informasi", $simpan->nama_client. " Berhasil di simpan!!");
                return redirect()->route('client.index');
            }
            throw new Exception("Gagal menyimpan data client!! dengan nama ", $input->nama_client);
        } catch (Exception $e) {
            $this->notification("error", "Gagal", "Terjadi Kesalahan ". $e->getMessage());
            return redirect()->route('client.index');
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
        
    }
}
