<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model
{
    use HasFactory;
    protected $primaryKey = 'compra_id';

    protected $fillable = [
        'compra_id',
        'materia_prima_id',
        'cantidad',
        'precio_unitario',
        'exenta',
        'iva5',
        'iva10',
    ];

    public function compra(){
        return $this->belongsTo('App\Models\Compra');
    }
    public function materia_prima(){
        return $this->belongsTo('App\Models\MateriaPrima');
    }
}
