<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Divisi\Divisi;
use App\Transform\TransformDivisi;
use App\Validation\DivisiValidation;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    protected $divisi;
    protected $transform;

    public function __construct()
    {
        $this->divisi = new Divisi;
        $this->transform = new TransformDivisi;
    }

    public function getList()
    {
        $divisi = $this->divisi->getDivisi();

        if(!$divisi->count()) {
            return response()->jsonApi(201, "Data divisi tidak ada!!");
        } 

        $transform = $this->transform->mapperDivisi($divisi);
        return response()->jsonApi(200, "Ok", $transform);
    }

    public function getDetail($kodePegawai)
    {
        $data = $this->divisi->getDivisiDetail($kodePegawai);

        if(!$data) {
            return response()->jsonApi(201, "Data tidak ditemukan!");
        }

        $transform = $this->transform->mapperDetail($data);
        return response()->jsonApi(200, "OK", $transform);
    }
}
