<?php

namespace App\Transform;

class TransformClient
{
    public function mapperClient($table)
    {
        foreach ($table as $value) {
            $data["client"][] = [
                'kode_client'   => $value->kode_client,
                'nama_client'   => $value->nama_client,
                'alamat_client' => $value->alamat_client,
                'no_telpon'     => $value->no_telepon,
                'npwp_client'   => $value->npwp_client,
                'created_at'    => $value->created_at,
            ];
        }
        return $data;
    }

    public function mapperDetail($table)
    {
        $data["client"] = [
            'kode_client'  => $table->kode_client,
            'nama_client'  => $table->nama_client,
            'alamat_client'  => $table->alamat_client,
            'no_telepon'  => $table->no_telepon,
            'npwp_client'  => $table->npwp_client,
            'created_at'  => $table->created_at,
        ];
        return $data;
    }

}