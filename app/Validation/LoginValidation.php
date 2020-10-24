<?php

namespace App\Validation;
use Validator;

class LoginValidation
{
    public function rules($request)
    {
        return Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'required' => 'Tidak boleh kosong!!'
        ]);
    }

    public function messages($errors)
    {
        $error = [];
        foreach($errors->getMessages() as $key => $value)
        {
            $error[] = $key. ' '.$value[0];
        }
        return $error;
    }
}