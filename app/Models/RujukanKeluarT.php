<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RujukanKeluarT extends Model
{
    protected $primaryKey = "rujukan_keluar_id";
    protected $table = "rujukan_keluar_t";

    protected $fillable = [
        'no_sep','kode_asal_rujukan','nama_asal_rujukan','kode_diagnosa','nama_diagnosa','no_rujukan',
        'jns_pelayanan', 'tipe_rujukan', 'hak_kelas','jns_peserta','kelamin','nama_peserta','no_kartu','no_rekamedik',
        'tgl_lahir','kode_poli','nama_poli','tgl_rujukan','kode_tujuan_rujukan','nama_tujuan_rujukan',
        'catatan','user'
    ];

    // public $timestamps = false;
}