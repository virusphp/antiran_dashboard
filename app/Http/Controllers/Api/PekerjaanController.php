<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Pekerjaan\Pekerjaan;
use App\Transform\TransformPekerjaan;

class PekerjaanController extends Controller
{
    protected $pekerjaan;
    protected $transform;

    public function __construct()
    {
        $this->pekerjaan = new Pekerjaan;
        $this->transform = new TransformPekerjaan;
    }

    public function getList()
    {
        $pekerjaan = $this->pekerjaan->getPekerjaan();

        if(!$pekerjaan->count()) {
            return response()->jsonApi(201, "Data pekerjaan tidak ada!!");
        } 

        $transform = $this->transform->mapperPekerjaan($pekerjaan);
        return response()->jsonApi(200, "Ok", $transform);
    }

    public function getDetail($kode)
    {
        $pekerjaan = $this->pekerjaan->getPekerjaanDetail($kode);

        if(!$pekerjaan) {
            return response()->jsonApi(201, "Data tidak ditemukan!");
        }

        $transform = $this->transform->mapperDetail($pekerjaan);
        return response()->jsonApi(200, "OK", $transform);
    }
}
