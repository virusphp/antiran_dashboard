<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SepInsert extends FormRequest
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
        return [
            'no_rujukan' => 'required',
            'ppk_rujukan' => 'required',
            'kode_diagnosa' => 'required',
            'kode_poli' => 'required',
            'no_telp' => 'required|min:8',
            'catatan' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'no_rujukan.required' => 'No Rujukan tidak boleh kosong',
            'ppk_rujukan.required' => 'PPK Rujukan tidak boleh kosong',
            'kode_diagnosa.required' => 'Diagnosa tidak boleh kosong',
            'kode_poli.required' => 'Poli Tujuan tidak boleh kosong',
            'no_telp.required' => 'No Telp tidak boleh kosong',
            'catatan.required' => 'Catatan tidak boleh kosong',
        ];
    }
}
