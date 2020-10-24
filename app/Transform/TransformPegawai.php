<?php

namespace App\Transform;

class TransformPegawai extends Transform
{
    public function mapperPegawai($table)
    {
        foreach ($table as $value) {
            $data["pegawai"][] = [
                'kode_pegawai'   => $value->kode_pegawai,
                'nama_pegawai'   => $value->nama_pegawai,
                'jenis_kelamin'  => jenisKelamin($value->jenis_kelamin),
                'tempat_lahir'   => $value->tempat_lahir,
                'tanggal_lahir'  => $value->tanggal_lahir,
                'nama_divisi'    => $value->nama_divisi,
            ];
        }
        return $data;
    }

    public function mapperDetail($table)
    {
        $data["pegawai"] = [
                'kode_pegawai'  => $table->kode_pegawai,
                'nama_pegawai'  => $table->nama_pegawai,
                'jenis_kelamin' => jenisKelamin($table->jenis_kelamin),
                'tempat_lahir'  => $table->tempat_lahir,
                'tanggal_lahir' => $table->tanggal_lahir,
                'nama_divisi'   => $table->nama_divisi,
        ];

        return $data;
    }
}