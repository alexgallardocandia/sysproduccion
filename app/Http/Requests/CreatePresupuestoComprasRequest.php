<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePresupuestoComprasRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $now = date('d/m/Y');
        return [
            'numero'        => 'required',
            'proveedor_id'  => 'required',
            'fecha'         => "required|date|before_or_equal:$now",
            'validez'       => 'required|date|after_or_equal:today',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) { 
            if( request()->detail_total <= 0 ) {
                $validator->errors()->add('detail_total','El presupuesto debe tener al menos un detalle');
            }
        });
    }
}
