<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCargosRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'descripcion'       => 'required',
            'departamento_id'   => 'required',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator){ });
    }
}
