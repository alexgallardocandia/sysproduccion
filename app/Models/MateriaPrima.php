<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MateriaPrima extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        
        'descripcion',
        'precio',
        'fecha_lote',
        'fecha_vencimiento',
        'umedida_id',
    ];
    public function umedida(){
        return $this->belongsTo('App\Models\UnidadMedida');
    }
}
