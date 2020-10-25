<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
use Carbon\Carbon;

class Registrasi extends Model
{
    use AutoNumberTrait;

    protected $table = 'registrasi';

    protected $primaryKey = 'no_registrasi';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['kode_pekerjaan', 'no_registrasi', 'kode_client', 'no_akta', 'lokasi_akta', 'tanggal_registrasi', 'user_id'];
    public function details()
    {
        return $this->hasMany(RegistrasiDetail::class, 'no_registrasi', 'no_registrasi');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'kode_client');
    }

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'no_registrasi');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class,'kode_pekerjaan');
    }

    public function getAutoNumberOptions()
    {
        return [
            'no_registrasi' => [
                'format' => 'R' . date('Ymd') . '?', // Format kode yang akan digunakan.
                'length' => 4 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }
}
