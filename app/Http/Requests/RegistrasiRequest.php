<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;

class RegistrasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [

            //client
            'nama_client' => 'required|min:3',
            'alamat_client' => 'required|min:6',
            'no_telepon' => 'required|min:8|max:15',
            'npwp_client' => 'required',

            //registrasi
            'kode_pekerjaan' => 'required|exists:pekerjaan,kode_pekerjaan',
            'no_akta' => 'required',
            'lokasi_akta' => 'required',
            //registrasi_detail
            'details.*.kode_proses' => 'required',
            'details.*.prioritas' => 'required|in:SESUAI,SEGERA',
            'details.*.tanggal_mulai' => 'required|date|date_format:d-m-Y',
            'details.*.tanggal_selesai' => 'nullable|date|date_format:d-m-Y|after:details.*.tanggal_mulai',

            //tagihan
            'total_biaya_proses' => 'required',
            'total_biaya_pajak' => 'required', // wajib diisi walaupun 0
            'keterangan' => 'required',

             //kwitansi
             'jumlah_bayar' => 'required', // wajib diisi walaupun 0
             'no_referensi' => Rule::requiredIf($request->jumlah_bayar > 0),
        ];
    }
}
