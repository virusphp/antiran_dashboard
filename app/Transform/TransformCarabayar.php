<?php

namespace App\Transform;

class TransformCarabayar
{
    public function mapCarabayar($table)
    {
        foreach($table as $value) {
            $data["carabayar"][] = [
                'kode_carabayar' => $value->kd_cara_bayar,
                'nama_carabayar' => $value->keterangan,
            ];
        }

        return $data;
    }

}