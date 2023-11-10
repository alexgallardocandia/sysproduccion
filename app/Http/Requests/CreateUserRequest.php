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
            'empleado_id'    => 'required'
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            
            $empleado_validate = User::where('empleado_id', request()->empleado_id)->first();

            if($empleado_validate) {
                $validator->errors()->add('empleado_id',"El empleado ya tiene un usuario creado");
            }
         });
    }
}
