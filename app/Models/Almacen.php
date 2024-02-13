<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Almacen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'almacenes';

    protected $fillable = [
        'descripcion',
        'sucursal_id'
    ];

    public function sucursal(){
        return $this->belongsTo('App\Models\Sucursal');
    }

    public function stock_materia_prima()
    {
        return $this->hasMany(StockMateriaPrima::class);
    }
}
