<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Pegawai\Pegawai;
use App\Transform\TransformPegawai;

class PegawaiController extends Controller
{
    protected $pegawai;
    protected $transform;

    public function __construct()
    {
        $this->pegawai   = new Pegawai();
        $this->transform = new TransformPegawai;
    }

    public function getList()
    {
        $pegawai   = $this->pegawai->getPegawai();

        if(!$pegawai->count()) {
            return response()->jsonApi(201, "Data tidak ditemukan!");
        }

        $transform = $this->transform->mapperPegawai($pegawai);

        return response()->jsonApi(200, "OK", $transform);
    }

    public function getDetail($kode)
    {
        $pegawai = $this->pegawai->getPegawaiDetail($kode);

        if(!$pegawai) {
            return response()->jsonApi(201, "Data tidak ditemukan!");
        }

        $transform = $this->transform->mapperDetail($pegawai);
        return response()->jsonApi(200, "Data Ditemukan", $transform);
    }
}
