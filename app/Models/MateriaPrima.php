<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MateriaPrima extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        
        'nombre',
        'presentacion',
        'fecha_lote',
        'fecha_vencimiento',
        'type',
        'umedida_id',
        'categoria_id',
        'marca_id', 
    ];
    public function umedida() {
        return $this->belongsTo('App\Models\UnidadMedida');
    }
    public function categoria() {
        return $this->belongsTo('App\Models\Categoria');
    }
    public function marca() {
        return $this->belongsTo('App\Models\Marca');
    }
    public function getFechaAttribute() {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha_lote'])->format('d/m/Y');
    }
    public function getVencimientoAttribute() {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha_vencimiento'])->format('d/m/Y');
    }
}










