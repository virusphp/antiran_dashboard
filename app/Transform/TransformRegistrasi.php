<?php

namespace App\Transform;

class TransformRegistrasi
{
    public function mapGenerateCode($table)
    {
        $data["generate"] = [
                'no_reg' => $table['no_reg'],
        ];

        return $data;
    }

}