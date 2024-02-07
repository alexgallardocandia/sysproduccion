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
            'fecha'         => "required|before_or_equal:$now",
            'validez'       => "required|after_or_equal:$now",
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) { 
            if( request()->detail_total <= 0 ) {
                $validator->errors()->add('detail_total','El presupuesto debe tener al menos un detalle');
            }
            if ( !request()->solicitante_id && !request()->pedido_compra_id ) {
                $validator->errors()->add('solicitante_id','El presupuesto debe tener, pedido compra o solicitante');
            }
            // dd(request()->all());
        });
    }
}
