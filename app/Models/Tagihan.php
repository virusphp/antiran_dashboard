<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use AutoNumberTrait;

    //no_registrasi
    public function registrasi()
    {
        return $this->belongsTo(Registrasi::class, 'no_registrasi');
    }

    public function kwitansis()
    {
        return $this->hasMany(Kwitansi::class,'no_tagihan');
    }

    //set tanggal_tagihan
    public function setTanggalTagihanAttribute()
    {
        return $this->attributes['tanggal_tagihan'] = Carbon::now();
    }
    
    public function setTotalBiayaPajakAttribute($value)
    {
        if (empty($value)) return 0; //default
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            //status_bayar
            //belum lunas karena blm ada pajak yang dihitung
            if ($model->total_biaya_pajak == 0 ) {
                return  $model->status_bayar = 0;
            }
            $total_harga = $model->total_harga_proses + $model->total_harga_pajak;
            if ($model->total_bayar !== $total_harga) {
                return $model->status_bayar = 0; //belum lunas
            }
            return $model->status_bayar = 1;
        });
    }

    //user_id

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getAutoNumberOptions()
    {
        return [
            'no_tagihan' => [
                'format' => 'T' . date('Ymd') . '?', // Format kode yang akan digunakan.
                'length' => 4 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }
}
