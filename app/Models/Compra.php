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
        'timbrado_id',
        'tipo_impuesto_id',
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
    ];

    public function proveedor()
    {
        return $this->belongsTo('App\Models\Proveedor');
    }
    public function orden_compra()
    {
        return $this->belongsTo('App\Models\OrdenCompra');
    }
    public function timbrado()
    {
        return $this->belongsTo('App\Models\Timbrado');
    }
    public function tipo_impuesto()
    {
        return $this->belongsTo('App\Models\TipoImpuesto');
    }
    public function details() {
        return $this->hasMany('App\Models\CompraDetalle');
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
