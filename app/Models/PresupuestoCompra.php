<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresupuestoCompra extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'numero',
        'estado',
        'fecha',
        'validez',
        'proveedor_id',
        'pedido_compra_id',
    ];

    public function proveedor(){
        return $this->belongsTo('App\Models\Proveedor');
    }
    public function pedido_compra(){
        return $this->belongsTo('App\Models\PedidoCompra');
    }
    public function details(){
        return $this->hasMany('App\Models\PresupuestoCompraDetalle');
    }
}
