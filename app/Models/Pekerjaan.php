<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Pekerjaan extends Model
{
    use AutoNumberTrait;

    protected $table = "pekerjaan";
    

    protected $primaryKey = 'kode_pekerjaan';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ["kode_pekerjaan", "nama_pekerjaan","keterangan_pekerjaan","insentif_pekerjaan"];

    public function setInsentifPekerjaanAttribute($value)
    {
        return $this->attributes['insentif_pekerjaan'] =  str_replace('.','',$value);
    }

    public function getAutoNumberOptions()
    {
        return [
            'kode_pekerjaan' => [
                'format' => 'PK' . date('Ymd') . '?', // Format kode yang akan digunakan.
                'length' => 3 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }
}

