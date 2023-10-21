<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $append   = [
        'fechaedit',
        'validezedit',
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
    public function getFechaAttribute() {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha'])->format('d/m/Y');
    }
    public function getValidez() {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['validez'])->format('d/m/Y');
    }
    public function getFechaeditAttribute() {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha'])->format('Y-m-d');
    }
    public function getValidezeditAttribute() {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['validez'])->format('Y-m-d');
    }
    public function getTotalDetalles() {
        return $this->details->sum(function ($detalle) {
            return $detalle->total;
        });
    }
}
