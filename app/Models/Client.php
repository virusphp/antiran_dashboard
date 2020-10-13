<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Client extends Model
{
    use AutoNumberTrait;
    
    protected $table = "client";
    protected $fillable = [
        'kode_client','nik_client','nama_client','jenis_kelamin','tempat_lahir','tanggal_lahir',
        'alamat_client','no_telepon','email_client','npwp_client'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'kode_client' => [
                'format' => 'P'.date('Ymd').'?', // Format kode yang akan digunakan.
                'length' => 4 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }

    public function setNpwpClientAttribute($value)
    {
        if(!empty($value)) $this->attributes['npwp_client'] = preg_replace('/\D/', '', $value);
    }
}
