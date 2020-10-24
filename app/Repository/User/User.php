<?php

namespace App\Repository\User;

use App\Models\User as UserModel;
use DB;

class User
{
    public function getUser()
    {
        return UserModel::query();
    }
    
    public function getProfil($email)
    {
        return DB::table('users')->select('name','username','email','created_at')->where('email',$email)->first();
    }
}
