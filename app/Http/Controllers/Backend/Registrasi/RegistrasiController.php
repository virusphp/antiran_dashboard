<?php

namespace App\Http\Controllers\Backend\Registrasi;

use App\Http\Controllers\Controller;
use App\Repository\Registrasi\Registrasi;
use App\Transform\TransformRegistrasi;
use Illuminate\Http\Request;

class RegistrasiController extends Controller
{
    protected $registrasi;
    protected $transform;

    public function __construct()
    {
        $this->registrasi = new Registrasi;
        $this->transform = new TransformRegistrasi;
    }

    public function generateCode(Request $request)
    {
        if ($request->ajax()) {
            $generateCode = $this->registrasi->generateCode($request);
            $transform = $this->transform->mapGenerateCode($generateCode);
            return response()->jsonApi(200, "OK", $transform);
        }
    }
}
