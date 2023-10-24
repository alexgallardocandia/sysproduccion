<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMateriaPrimaRequest extends FormRequest
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
            "nombre"            => 'required',
            "categoria_id"      => 'required',
            "presentacion"      => 'required',
            "marca_id"          => 'required',
            "umedida_id"        => 'required',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            //VALIDACION DE FECHAS EN EL CASO QUE LA CATEGORIA SEA DIFERENTE A FRUTAS O VERDURAS
            if ( ( request()->categoria_id != 4 && request()->categoria_id != 5 ) && ( request()->fecha_lote == NULL || request()->fecha_vencimiento == NULL ) ) {
                $validator->errors()->add('fecha_lote',"Los campos de fecha son obligatorios si la categoria es frutas o verduras");
            }

         });
    }
}
