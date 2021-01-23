<?php

namespace App\Repository\User;

use App\Models\User as UserModel;
use DB;

class User
{
    public function getUser()
    {
        return DB::table('user_login_sep as u')
            ->select('u.id_user','u.kd_pegawai','u.nama_pegawai','u.role','p.unit_kerja')
            ->join('pegawai as p', 'u.kd_pegawai','p.kd_pegawai')
            ->get();
    }
    
    public function getProfil($email)
    {
        return DB::table('users')->select('name','username','email','created_at')->where('email',$email)->first();
    }
}
