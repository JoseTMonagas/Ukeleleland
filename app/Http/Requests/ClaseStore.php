<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClaseStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->user()->role->name === 'tutor') {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fecha_clase' => 'required|date',
            'duracion' => 'required',
            'tarifa' => 'required',
            'observaciones', 'max:255'
        ];
    }
}
