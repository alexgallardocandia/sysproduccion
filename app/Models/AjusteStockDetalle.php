<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjusteStockDetalle extends Model
{
    use HasFactory;

    protected $primaryKey = 'ajuste_stock_id';

    protected $fillable = [
        'ajuste_stock_id',
        'materia_prima_id',
        'cant_stock',
        'cant_almacen',
        'motivo',
    ];

    public function ajuste_stock()
    {
        return $this->belongsTo('App\Models\AjusteStock');
    }
    public function materia_prima()
    {
        return $this->belongsTo('App\Models\MateriaPrima');
    }
}
