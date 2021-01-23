<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->user ?? '';
        $rules = [
            'nama_pegawai' => 'required',
            'kd_pegawai' => 'required',
            'password' => 'required|confirmed',
            'role' => 'required'
        ];

        if ($this->isMethod('PATCH')) {
            $rules['password'] = 'nullable|confirmed';
        }

        return $rules;
    }
}
