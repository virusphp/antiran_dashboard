<?php

namespace App\Transform;

class TransformCaramasuk
{
    public function mapCaramasuk($table)
    {
        foreach($table as $value) {
            $data["caramasuk"][] = [
                'kode_caramasuk' => $value->kd_asal_pasien,
                'nama_caramasuk' => $value->keterangan,
            ];
        }

        return $data;
    }

}