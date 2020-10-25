<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
use Carbon\Carbon;

class Kwitansi extends Model
{
    use AutoNumberTrait;
    protected $table = 'kwitansi';

    protected $fillable = [
        'no_kwitansi',
        'no_tagihan',
        'kode_pembayaran',
        'jumlah_bayar',
        'no_referensi',
        'tanggal_kwitansi',
        'user_id'
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class,'no_tagihan');
    }
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class,'kode_pembayaran');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function setTanggalKwitansiAttribute()
    {
        return $this->attributes['tanggal_kwitansi'] = Carbon::now();
    }

    public function setJumlahBayarAttribute($value)
    {
         if(!empty($value)) return $this->attributes['jumlah_bayar'] = str_replace('.', '', $value);
    }

    public function getAutoNumberOptions()
    {
        return [
            'no_kwitansi' => [
                'format' => 'K' . date('Ymd') . '?', // Format kode yang akan digunakan.
                'length' => 4 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }
}
