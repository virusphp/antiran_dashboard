<?php

namespace App\Transform;

class TransformProses
{
    public function mapperProses($table)
    {
        foreach ($table as $value) {
            $data["proses"][] = [
                'kode_proses'   => $value->kode_proses,
                'nama_proses'   => $value->nama_proses,
                'waktu_proses'   => $value->waktu_proses
            ];
        }
        return $data;
    }

    public function mapperDetail($table)
    {
        $data["proses"] = [
            'kode_proses'  => $table->kode_proses,
            'nama_proses'  => $table->nama_proses,
            'waktu_proses'   => $table->waktu_proses
        ];
        return $data;
    }

}