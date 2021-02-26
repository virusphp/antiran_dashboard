<?php

namespace App\Transform;

class TransformPasien
{
    public function mapperPasien($table)
    {
        $data["pasien"] = [
                'no_rm'         => $table->no_rm,
                'nik'           => $table->nik,
                'nama_pasien'   => $table->nama_pasien,
                'tempat_lahir'  => $table->tempat_lahir,
                'tanggal_lahir' => $table->tgl_lahir,
                'jenis_kelamin' => jenisKelamin($table->jns_kel),
                'alamat_pasien' => $table->alamat. " " .$table->rt. " " .$table->rw. " " .$table->nama_kelurahan. " " .$table->nama_kecamatan,
                'no_telp'       => $table->no_telp,
                'no_kartu'      => $table->no_kartu,
        ];

        return $data;
    }

}