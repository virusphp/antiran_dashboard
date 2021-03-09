<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
            'kodekelas' => getKelas($this->kd_kelas),
            'koderuang' => $this->keterangan,
            'namaruang' => gantiKata($this->nama_sub_unit)." ".$this->keterangan." (".$this->nama_jenis_kamar.")",
            'kapasitas' => "1",
            'tersedia' => ($this->status == 1 || $this->status == 2 ? "0" : "1"),
            'tersediapria' => ($this->status == 0 && $this->kelamin == "L" ? "1" : ($this->status == 0 && $this->kelamin == "C" ? "1" : "0")),
            'tersediawanita' => ($this->status == 0 && $this->kelamin == "P" ? "1" : ($this->status == 0 && $this->kelamin == "C" ? "1" : "0")),
            'tersediapriawanita' => ($this->status == 0 && $this->kelamin == "C" ? "1" : "0")
       ];
    }
}
