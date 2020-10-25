<?php

namespace App\Repository\Registrasi;

// use Illuminate\Support\Facades\Request;
use App\Models\Registrasi as RegistrasiModel;
class Registrasi
{
    public function getRegistrasi()
    {
        return RegistrasiModel::select('id','no_registrasi','kode_pekerjaan','kode_client','no_akta','lokasi_akta','tanggal_registrasi')->get();
    }
    
}