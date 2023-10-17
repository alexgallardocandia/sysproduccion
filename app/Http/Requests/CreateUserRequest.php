<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'persona_id'    => 'required'
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            
            $persona_validate = User::where('persona_id', request()->persona_id)->first();

            if($persona_validate) {
                $validator->errors()->add('persona_id',"La persona ya tiene un usuario creado");
            }
         });
    }
}
