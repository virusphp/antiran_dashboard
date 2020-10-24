<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Akun\Access;
use App\Validation\RegistrasiPlatform;
use App\Transform\TransformAccess;

class RegistrasiPlatformController extends Controller
{
    protected $access;
    protected $transform;

    public function __construct()
    {
        $this->access = new Access;
        $this->transform = new TransformAccess;
    }
    public function register(Request $r, RegistrasiPlatForm $valid)
    {
        $validate = $valid->rules($r);

        if ($validate->fails()) {
            $message = $valid->messages($validate->errors());
            return response()->jsonApi(422, implode(",",$message));
        }

        $akun = $this->access->simpan($r);

        if ($akun) {
            $transform = $this->transform->mapperFirst($akun);
            return response()->jsonApi(200, "Registrasi Sukses!", $transform);
        }
        $message = [
            "messageError" => "Internal server error"
        ];
        return response()->jsonError(500, $message["messageError"]);
    }
}
