<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use AutoNumberTrait;
    protected $table = 'tagihan';
    
    protected $primaryKey = 'no_tagihan';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable =['no_registrasi','no_tagihan','tanggal_tagihan','total_biaya_proses','total_biaya_pajak','status_bayar','keterangan','user_id'];
    //no_registrasi
    public function registrasi()
    {
        return $this->belongsTo(Registrasi::class, 'no_registrasi');
    }

    public function kwitansis()
    {
        return $this->hasMany(Kwitansi::class,'no_tagihan');
    }

    // public function setTotalBiayaPajakAttribute($value)
    // {
    //     if (empty($value)) return 0; //default
    // }
    
    //user_id

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
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
            if ($model->jumlah_bayar !== $total_harga) {
                return $model->status_bayar = 0; //belum lunas
            }
            return $model->status_bayar = 1;
        });
    }

    public function setTotalBiayaProsesAttribute($value)
    {
         return $this->attributes['total_biaya_proses'] = str_replace('.', '', $value);
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
