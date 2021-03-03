<?php

namespace App\Transform;

class TransformPenjamin
{
    public function mapPenjamin($table)
    {
        foreach($table as $value) {
            $data["penjamin"][] = [
                'kode_penjamin' => $value->kd_penjamin,
                'nama_penjamin' => $value->nama_penjamin,
            ];
        }

        return $data;
    }

}