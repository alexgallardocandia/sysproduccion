<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'proveedor_id',
        'orden_compra_id',
        'solicitante_id',
        'timbrado',
        'vencimiento_timbrado',
        'fecha',
        'nro_factura',
        'condicion',
        'razon_social',
        'ruc',
        'direccion',
        'telefono',
        'email',
        'electronico',
        'descuento',
        'estado',
    ];

    public function proveedor()
    {
        return $this->belongsTo('App\Models\Proveedor');
    }
    public function solicitante()
    {
        return $this->belongsTo('App\Models\Empleado');
    }
    public function orden_compra()
    {
        return $this->belongsTo('App\Models\OrdenCompra');
    }
    public function timbrado()
    {
        return $this->belongsTo('App\Models\Timbrado');
    }
    public function details() {
        return $this->hasMany('App\Models\CompraDetalle');
    }
    public function compra_cuota()
    {
        return $this->hasMany('App\Models\CompraCuota');
    }
    public function getFechaAttribute() {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha'])->format('d/m/Y');
    }
    public function getTotalDetalles() {
        
        $this->load('details');

        return $this->details->sum(function ($detalle) {
            return $detalle->precio_unitario * $detalle->cantidad;
        });
    }
}
