<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasienRequest extends FormRequest
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
            'nama' => 'max:255',
            'email' => 'max:255',
            'nohp' => 'max:12',
            'ttl' => 'max:255',
            'jeniskelamin' => 'max:255',
            'dateappoint' => 'max:255',
            'jenisappointment' => 'max:255',
            'keterangan' => 'max:255',
            'status' => 'max:255',
        ];
    }
}
