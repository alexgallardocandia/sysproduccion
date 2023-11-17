<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoCompraDetalle extends Model
{
    use HasFactory;

    protected $primaryKey = 'pedido_compra_id';

    protected $fillable = [
        'pedido_compra_id',
        'materia_prima_id',
        'cantidad',
    ];

    public function pedido_compra(){
        return $this->belongsTo('App\Models\PedidoCompra');
    }
    public function materia_prima(){
        return $this->belongsTo('App\Models\MateriaPrima');
    }
}
        