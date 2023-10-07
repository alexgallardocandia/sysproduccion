<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresupuestoCompraDetalle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'presupuesto_id',
        'materia_prima_id',
        'cantidad',
        'precio_unitario',
        'umedid_id'
    ];

    public function presupuesto(){
        return $this->belongsTo('App\Models\Presupuesto');
    }
    public function materia_prima(){
        return $this->belongsTo('App\Models\MateriaPrima');
    }
    public function umedid(){
        return $this->belongsTo('App\Models\UnidadMedida');
    }
}
