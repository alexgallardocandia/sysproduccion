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
        'descripcion',
        'tipo',
        'precio',
        'tipo_impuesto_id',
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
    /**
     * Get the user that owns the MateriaPrima
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo_impuesto()
    {
        return $this->belongsTo(TipoImpuesto::class);
    }
    /**
     * Get all of the comments for the MateriaPrima
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stock_materia_prima()
    {
        return $this->hasMany(StockMateriaPrima::class);
    }
    // public function getFechaAttribute() {
    //     return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha_lote'])->format('d/m/Y');
    // }
    // public function getVencimientoAttribute() {
    //     return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha_vencimiento'])->format('d/m/Y');
    // }
}










