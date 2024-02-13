<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Compra;

class CompraCuota extends Model
{
    use HasFactory;

    protected $primaryKey = 'compra_id';

    protected $fillable = [
        'compra_id',
        'cuota_nro',
        'monto_cuota',
        'saldo',
        'fecha_vencimiento',
        'estado',
    ];

    public function compra() {
        return $this->belongsTo('App\Models\Compra');
    }

}
