<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaCredito extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'proveedor_id',
        'compra_id',
        'motivo_id',
        'timbrado_id',
        'fecha',
    ];

    public function details()
    {
        return $this->hasMany(NotaCreditoDetalle::class);
    }
    
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }
    public function motivo()
    {
        return $this->belongsTo(NotaCreditoMotivo::class);
    }
    public function timbrado()
    {
        return $this->belongsTo(Timbrado::class);
    }

    public function getFechaAttribute() 
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha'])->format('d/m/Y');
    }
    public function getTotalDetalles() {
        
        $this->load('details');

        return $this->details->sum(function ($detalle) {
            return $detalle->precio_unitario * $detalle->cantidad;
        });
    }

}
