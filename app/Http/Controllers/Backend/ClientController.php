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
                $query->where('nama_client', 'like', $keywords);
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
        $bcrum = $this->bcrum('Edit', route('client.index'), 'Client');

        $dataClient = Client::find($id);

        return view('backend.client.edit', compact('bcrum', 'dataClient'));
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
            $client = Client::find($id);
            $updateClient = $client->update($input);
            if ($updateClient) {
                $this->notification('success', 'Berhasil', 'Berhasil Ubah ' . $request->nama_client);
                return redirect()->route('client.index');
            }
            throw new Exception('Gagal Mengubah client ' . $request->nama_client);
        } catch (Exception $e) {
            $this->notification('error', 'Gagal', 'Terjadi kesalahan ' . $e->getMessage());
            return redirect()->route('client.index');
        }
    }
}
