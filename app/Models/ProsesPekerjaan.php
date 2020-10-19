<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class ProsesPekerjaan extends Model
{
    use AutoNumberTrait;

    protected $table = 'proses_pekerjaan';
    protected $fillable = ['kode_proses', 'nama_proses', 'waktu_proses', 'status_proses'];

    public function getAutoNumberOptions()
    {
        return [
            'kode_proses' => [
                'format' => 'PP' . date('Ymd') . '?', // Format kode yang akan digunakan.
                'length' => 3 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }
}
