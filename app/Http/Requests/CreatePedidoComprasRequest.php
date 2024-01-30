<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePedidoComprasRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [            
            'empleado_id'   => 'required'
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator)
        {
            if(request()->empleado_id == 'Seleccione...'){
                $validator->errors()->add('empleado_id',"El campo PERSONA es requerido");
            }
            //validacion del detalle
            if(request()->detail_total == 0){
                $validator->errors()->add('detail_total','El pedido debe tener al menos un detalle');
            }
            // //Punto de expedicion null
            // if(request()->expedition_point[0] == null)
            // {
            //     $validator->errors()->add('enterprise_id','El campo PUNTO DE EXPEDICION es obligatorio');
            // }
        });
    }
}
