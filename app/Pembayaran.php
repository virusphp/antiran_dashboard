<?php

namespace App;

use App\Models\Kwitansi;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    public function kwitansi()
    {
        return $this->hasMany(Kwitansi::class,'kode_pembayaran');
    }
}
