<?php

namespace App\Transform;

class TransformPekerjaan
{
    public function mapperPekerjaan($table)
    {
        foreach ($table as $value) {
            $data["pekerjaan"][] = [
                'kode_pekerjaan'   => $value->kode_pekerjaan,
                'nama_pekerjaan'   => $value->nama_pekerjaan,
                'insentif_pekerjaan'   => $value->insentif_pekerjaan
            ];
        }
        return $data;
    }

    public function mapperDetail($table)
    {
        $data["pekerjaan"] = [
            'kode_pekerjaan'  => $table->kode_pekerjaan,
            'nama_pekerjaan'  => $table->nama_pekerjaan,
            'insentif_pekerjaan'   => $table->insentif_pekerjaan
        ];
        return $data;
    }

}