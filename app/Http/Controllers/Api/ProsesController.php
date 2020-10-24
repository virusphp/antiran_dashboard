<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Proses\Proses;
use App\Transform\TransformProses;

class ProsesController extends Controller
{
    protected $proses;
    protected $transform;

    public function __construct()
    {
        $this->proses = new Proses;
        $this->transform = new TransformProses;
    }

    public function getList()
    {
        $proses = $this->proses->getProses();

        if(!$proses->count()) {
            return response()->jsonApi(201, "Data tidak ada!!");
        } 

        $transform = $this->transform->mapperProses($proses);
        return response()->jsonApi(200, "Ok", $transform);
    }

    public function getDetail($kode)
    {
        $proses = $this->proses->getProsesDetail($kode);

        if(!$proses) {
            return response()->jsonApi(201, "Data tidak ditemukan!");
        }

        $transform = $this->transform->mapperDetail($proses);
        return response()->jsonApi(200, "OK", $transform);
    }
}
