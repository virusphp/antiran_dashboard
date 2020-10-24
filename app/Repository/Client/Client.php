<?php

namespace App\Repository\Client;

use DB;

class Client 
{
    public function getClient()
    {
        return DB::table('client')->select('kode_client', 'nama_client','alamat_client','no_telepon','npwp_client','created_at')->get();
    }

    public function getClientDetail($kode)
    {
        return DB::table('client')->select('kode_client', 'nama_client','alamat_client','no_telepon','npwp_client','created_at')->where('kode_client',$kode)->first();
    }
}