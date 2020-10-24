<?php

namespace App\Transform;

class TransformDivisi
{
    public function mapperDivisi($table)
    {
        foreach ($table as $value) {
            $data["divisi"][] = [
                'kode_divisi'   => $value->kode_divisi,
                'nama_divisi'   => $value->nama_divisi
            ];
        }
        return $data;
    }

    public function mapperDetail($table)
    {
        $data["divisi"] = [
            'kode_divisi'  => $table->kode_divisi,
            'nama_divisi'  => $table->nama_divisi
        ];
        return $data;
    }

}