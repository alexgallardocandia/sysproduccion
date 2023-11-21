<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresupuestoCompraDetalle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'presupuesto_compra_id',
        'materia_prima_id',
        'cantidad',
        'precio_unitario',
        'estado',
    ];
    protected $append   = [
        'total'
    ];
    public function presupuesto(){
        return $this->belongsTo('App\Models\PresupuestoCompra');
    }
    public function materia_prima(){
        return $this->belongsTo('App\Models\MateriaPrima');
    }
    public function getTotalAttribute() {
        return $this->attributes['cantidad'] * $this->attributes['precio_unitario'] - $this->attributes['descuento'];
    }

}
