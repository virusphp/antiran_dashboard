<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $table = "pekerjaan";

    protected $fillable = ["nama_pekerjaan","keterangan_pekerjaan","insentif_pekerjaan"];

    public function setInsentifPekerjaanAttribute($value)
    {
        return $this->attributes['insentif_pekerjaan'] =  str_replace('.','',$value);
    }
}

