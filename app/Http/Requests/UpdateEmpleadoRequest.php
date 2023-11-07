<?php

namespace App\Http\Requests;

use App\Models\Empleado;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpleadoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $empleado_ci = Empleado::where('ci', request()->ci)->where('id','!=',request()->empleado_id)->first();
            
            if ($empleado_ci) {
                $validator->errors()->add('ci',"El numero de cedula ya esta registrada con el empleado $empleado_ci->fullname #$empleado_ci->id");
            }
        });
    }
}
