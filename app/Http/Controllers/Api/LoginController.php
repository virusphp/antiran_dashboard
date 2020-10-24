<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Validation\LoginValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\User\User;
use App\Transform\TransformUser;

class LoginController extends Controller
{
    private $user;
    private $transform;

    public function __construct()
    {
        $this->user = new User;
        $this->transform = new TransformUser();
    }

    public function login(Request $r, LoginValidation $valid)
    {
        $validate = $valid->rules($r);

        if ($validate->fails()) {
            $message = $valid->messages($validate->errors());
            return response()->jsonApi(422, implode(",",$message));
        }

        $data = ["email" => $r->email, "password" => $r->password];

        if (!Auth::attempt($data)) {
            $message = [
                "messageError" => "Username atau password salah! tidak di izinkan"
            ];
            return response()->jsonApi(403, $message["messageError"]);
        }

        $user =  $this->user->getProfil($data["email"]);

        $transform = $this->transform->mapperDetail($user);

        return response()->jsonApi(200, "OK", $transform);
    }
}
