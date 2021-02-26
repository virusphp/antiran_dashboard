<?php

namespace App\Transform;

class TransformKlinik
{
    public function mapKlinik($table)
    {
        foreach($table as $value) {
            $data["poliklinik"][] = [
                    'kode_klinik' => $value->kd_sub_unit,
                    'nama_klinik' => $value->nama_sub_unit,
                    'kode_tarif'  => $value->kd_tarif,
                    'rek_p'       => $value->rek_p,
                    'harga'       => (int)$value->harga,
                    'kode_dokter' => $value->kd_pegawai,
                    'nama_dokter' => $value->nama_pegawai,
            ];
        }

        return $data;
    }

}