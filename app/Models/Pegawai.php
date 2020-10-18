<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Pegawai extends Model
{
    use AutoNumberTrait;

    protected $table = "pegawai";
    protected $fillable = ['kode_pegawai','nama_pegawai','tempat_lahir','tanggal_lahir','jenis_kelamin','divisi_id'];

    public function getAutoNumberOptions()
    {
        return [
            'kode_pegawai' => [
                'format' => 'P'.date('Ymd').'?', // Format kode yang akan digunakan.
                'length' => 3 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }
}