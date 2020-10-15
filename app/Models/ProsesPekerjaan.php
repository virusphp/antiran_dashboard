<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProsesPekerjaan extends Model
{
    protected $table = 'proses_pekerjaan';
    protected $fillable = ['kode_proses', 'nama_proses', 'waktu_proses', 'status_proses'];
}
