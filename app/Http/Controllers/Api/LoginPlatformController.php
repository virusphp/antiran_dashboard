<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Akun\Access;
use App\Transform\TransformAccess;
use App\Validation\LoginValidation;
use Illuminate\Http\Request;
use Auth;

class LoginPlatformController extends Controller
{
    public function __construct()
    {
        $this->access = new Access;
        $this->transform = new TransformAccess;
    }

    public function login(Request $r, LoginValidation $valid)
    {
        $validate = $valid->rules($r);

        if ($validate->fails()) {
            $message = $valid->messages($validate->errors());
            return response()->jsonApi(422, implode(",",$message));
        }

        $data = ["username" => $r->username, "password" => $r->password];

        if (!Auth::guard("access")->attempt($data)) {
            $message = [
                "messageError" => "Username atau password salah! tidak di izinkan"
            ];
            return response()->jsonApi(403, $message["messageError"]);
        }

        $akun =  $this->access->getProfil($data["username"]);
        $transform = $this->transform->mapperFirst($akun);

        return response()->jsonApi(200, "Login Sukses!", $transform);

    }
}
