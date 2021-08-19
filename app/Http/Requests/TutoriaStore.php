<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutoriaStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();
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
            'tipo' => 'required|in:hora,clase',
            'cantidad' => 'required|numeric|gt:0',
            'fecha_inicio' => 'required|date',
            'fecha_termino' => 'required|date',
            'user_id' => 'required|numeric|exists:users',
            'observaciones' => 'max:255'
        ];
    }
}
