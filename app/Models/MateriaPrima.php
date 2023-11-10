<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MateriaPrima extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'nombre',
        'unidad_medida_id',
        'marca_id',
        'categoria_id',
        'tipo',
    ];
    public function unidad_medida() {
        return $this->belongsTo('App\Models\UnidadMedida');
    }
    public function categoria() {
        return $this->belongsTo('App\Models\Categoria');
    }
    public function marca() {
        return $this->belongsTo('App\Models\Marca');
    }
    // public function getFechaAttribute() {
    //     return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha_lote'])->format('d/m/Y');
    // }
    // public function getVencimientoAttribute() {
    //     return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha_vencimiento'])->format('d/m/Y');
    // }
}










