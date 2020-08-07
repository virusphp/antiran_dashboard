<?php

namespace App\Repository\Akun;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class Akun
{
    public function simpan($params)
    {
        // dd($params->mac_address);
        try {
            $akun =  DB::table('akun')->insert([
                'kd_pegawai' => $params->kode_pegawai,
                'mac_address' => $params->mac_address,
                'password' => bcrypt($params->password),
                'api_token' => generate_token($params->kode_pegawai, $params->password),
                'created_at' => Carbon::now(),
            ]);

            if ($akun) {
                $akun = DB::connection('sqlsrv_sms')
                    ->table('akun as a')
                    ->select('a.kd_pegawai','a.mac_address', 'a.status_update','a.created_at','a.api_token',
                            'p.nama_pegawai','p.gelar_depan','p.gelar_belakang','p.unit_kerja')
                    ->join('dbsimrs.dbo.pegawai as p', 'a.kd_pegawai','=', 'p.kd_pegawai')
                    ->where('a.kd_pegawai', $params->kode_pegawai)
                    ->first();
                return $akun;
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}