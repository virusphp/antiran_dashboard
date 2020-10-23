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
        'tanggal_tagihan',
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
    public function setTanggalTagihanAttribute()
    {
        return $this->attributes['tanggal_tagihan'] = Carbon::now();
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
