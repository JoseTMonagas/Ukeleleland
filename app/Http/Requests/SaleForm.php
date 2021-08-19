<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleForm extends FormRequest
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
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'sometimes',
            'email' => 'required',
            'rut' => 'required',
            'commune' => 'required|exists:communes,name',
            'address' => 'required',
        ];
    }
}
