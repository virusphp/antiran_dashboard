<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RegistrasiDetail extends Model
{
    protected $table = 'registrasi_detail';

    protected $fillable = ['kode_proses', 'no_registrasi', 'prioritas', 'tanggal_mulai', 'tanggal_selesai', 'status_proses'];


    public function registrasi()
    {
        return $this->belongsTo(Registrasi::class,'no_registrasi');
    }
    public function setTanggalMulaiAttribute($value)
    {
        return $this->attributes['tanggal_mulai'] = Carbon::createFromFormat('d-m-Y', $value);
    }

    public function setTanggalSelesaiAttribute($value)
    {
        return $this->attributes['tanggal_selesai'] = Carbon::createFromFormat('d-m-Y', $value);
    }
}
