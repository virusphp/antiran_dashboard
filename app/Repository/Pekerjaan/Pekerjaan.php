<?php

namespace App\Repository\Pekerjaan;

use App\Models\Pekerjaan as PekerjaanModel;

class Pekerjaan
{ 
    public function getPekerjaan()
    {
        return PekerjaanModel::select('id','nama_pekerjaan','keterangan_pekerjaan','insentif_pekerjaan','created_at')->get();
    }
}
