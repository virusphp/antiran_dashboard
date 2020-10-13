<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "client";
    protected $fillable = [
        'kode_client','nik_client','nama_client','jenis_kelamin','tempat_lahir','tanggal_lahir',
        'alamat_client','no_telepon','email_client','npwp_client'
    ];
}
