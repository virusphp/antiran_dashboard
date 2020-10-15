<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Divisi extends Model
{
    use AutoNumberTrait;

    protected $fillable = ['kode_divisi','nama_divisi'];
    protected $table = 'divisi';

     public function getAutoNumberOptions()
    {
        return [
            'kode_divisi' => [
                'format' => 'D'.date('Ymd').'?', // Format kode yang akan digunakan.
                'length' => 3 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }
}
