<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoCompraDetalle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pedido_compra_id',
        'materia_prima_id',
        'cantidad',
        'umedid_id',
    ];

    public function pedido_compra(){
        return $this->belongsTo('App\Models\PedidoCompra');
    }
    public function materia_prima(){
        return $this->belongsTo('App\Models\MateriaPrima');
    }
    public function umedida(){
        return $this->belongsTo('App\Models\UnidadMedida');
    }
}
        