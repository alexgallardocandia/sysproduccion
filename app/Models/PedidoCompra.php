<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoCompra extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'prioridad',
        'estado',
        'user_id',
        'fecha_pedido',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function details(){
        return $this->hasMany('App\Models\PedidoCompraDetalle');
    }
}