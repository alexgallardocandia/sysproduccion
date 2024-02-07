<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompraDetalle extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'orden_compra_id';

    protected $fillable = [
        'orden_compra_id',
        'materia_prima_id',
        'cantidad',
        'precio_unitario',
    ];

    public function orden_compra(){
        return $this->belongsTo('App\Models\OrdenCompra');
    }
    public function materia_prima(){
        return $this->belongsTo('App\Models\MateriaPrima');
    }
}
