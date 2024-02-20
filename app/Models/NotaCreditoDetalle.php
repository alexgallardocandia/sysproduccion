<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaCreditoDetalle extends Model
{
    use HasFactory;

    protected $primaryKey = 'nota_credito_id';

    
    protected $fillable = [
        'nota_credito_id',
        'materia_prima_id',
        'cantidad',
        'precio_unitario',
        'exenta',
        'iva_5',
        'iva_10',
    ];

    public function nota_credito()
    {
        return $this->belongsTo(NotaCredito::class);
    }
    public function materia_prima()
    {
        return $this->belongsTo(MateriaPrima::class);
    }
}
