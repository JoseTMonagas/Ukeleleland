<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdate extends FormRequest
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
            'name' => 'max:255',
            'surname' => 'max:255',
            'user_id' => 'numeric|exists:users,id',
            'password' => '',
            'password_confirmation' => '',
            'commune_id' => 'numeric|exists:communes,id',
            'phone' => 'filled',
            'rut' => 'filled',
            'address' => 'filled',
            'image' => 'filled|file'
        ];
    }
}
