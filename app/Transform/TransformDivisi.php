<?php

namespace App\Transform;

class TransformDivisi
{
    public function mapperFirst($table)
    {
        $data["absen"] = [
                'tanggal'      => tanggal($table->tanggal),
                'jam'          => waktu($table->jam),
                'status_absen' => $table->status_absen,
        ];
        return $data;
    }

    public function mapperDivisi($table)
    {
        foreach ($table as $value) {
            $data["list"][] = [
                'kode_divisi'   => $value->kode_divisi,
                'nama_divisi'   => $value->nama_divisi
            ];
        }
        return $data;
    }

}