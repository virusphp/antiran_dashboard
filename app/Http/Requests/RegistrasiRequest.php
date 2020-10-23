<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {

        //hasil input 
        // array:7 [
        //     "_token" => "9GhBhJLRfUzBSaziAiR0zi4Lv0NIkcbmnaBd6Vqe"
        //     "nama_client" => "A"
        //     "alamat_client" => "A"
        //     "no_telepon" => "A"
        //     "npwp_client" => "2"
        //     "kode_pekerjaan" => "PK20201023001"
        //     "details" => array:1 [
        //       0 => array:4 [
        //         "kode_proses" => "PP20201023001"
        //         "prioritas" => "SESUAI"
        //         "tanggal_mulai" => "24-10-2020"
        //         "tanggal_selesai" => "25-10-2020"
        //       ]
        //       ],   
        //     "total_biaya_proses" => "200.000"
        //     "total_biaya_pajak" => "0"
        //     "total_bayar" => "100.000"
        //     "no_referensi" => "2000202020"
        //     "keterangan" => "ADAWDA"
        //   ]
        return [

            //client
            'nama_client' => 'required|min:3',
            'alamat_client' => 'required|min:6',
            'no_telepon' => 'required|min:8|max:15',
            'npwp_client' => 'required',

            //registrasi
            'kode_pekerjaan' => 'required|exists:pekerjaan,kode_pekerjaan',
            //registrasi_detail
            'details.*.kode_proses' => 'required',
            'details.*.prioritas' => 'required|in:SESUAI,SEGERA',
            'details.*.tanggal_mulai' => 'required|date|date_format:d-m-Y',
            'details.*.tanggal_selesai' => 'required|date|date_format:d-m-Y|after:details.*.tanggal_mulai',

            //kwitansi
            'total_biaya_proses' => 'required_if:_pembayaran,1',
            'total_bayar' => 'required_if:_pembayaran,1',
            'total_biaya_pajak' => 'nullable',
            'no_referensi' => 'required_if:_pembayaran,1',
            'keterangan' => 'nullable'
        ];
    }
}
