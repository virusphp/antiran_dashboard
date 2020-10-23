<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
use Carbon\Carbon;

class Registrasi extends Model
{
    use AutoNumberTrait;

    public function details()
    {
        return $this->hasMany(RegistrasiDetail::class,'no_registrasi');

    }

    public function client()
    {
        return $this->belongsTo(Client::class,'kode_client');
    }

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class,'no_registrasi');
    }

    public function setTanggalRegistrasiAttribute()
    {
        return $this->attributes['tanggal_registrasi'] = Carbon::now();
    }
    
    public function getAutoNumberOptions()
    {
        return [
            'no_registrasi' => [
                'format' => 'R'.date('Ymd').'?', // Format kode yang akan digunakan.
                'length' => 4 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }
    
}
