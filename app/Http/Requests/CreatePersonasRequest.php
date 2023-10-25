<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class CreatePersonasRequest extends FormRequest
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
        $validator->after(function ($validator)
        {
            $persona_ci = DB::select('SELECT * FROM personas WHERE ci = ?', [request()->ci]);
            
            if($persona_ci){
                $validator->errors()->add('ci',"El numero de cedula ya esta registrada");
            }
            //validacion de ci
            // if(request()->detail_total == 0){
            //     $validator->errors()->add('detail_total','El pedido debe tener al menos un detalle');
            // }
        });
    }
}
