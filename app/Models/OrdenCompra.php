<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'fecha',
        'presupuesto_compra_id',
        'solicitante_id',
        'observacion',
        'descuento',
        'autorizador_id',
        'estado',
    ];

    public function solicitante() {
        return $this->belongsTo('App\Models\Empleado');
    }
    public function autorizador() {
        return $this->belongsTo('App\Models\Empleado');
    }
    public function details() {
        return $this->hasMany('App\Models\OrdenCompraDetalle');
    }
    public function getFechaAttribute() {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha'])->format('d/m/Y');
    }
    public function presupuesto_compra() 
    {
        return $this->belongsTo('App\Models\PresupuestoCompra');
    }

    public function getTotalDetalles() {
        
        $this->load('details');

        return $this->details->sum(function ($detalle) {
            return $detalle->precio_unitario * $detalle->cantidad;
        });
    }
}
