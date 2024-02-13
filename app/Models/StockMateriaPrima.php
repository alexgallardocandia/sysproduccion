<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMateriaPrima extends Model
{
    use HasFactory;
        
    protected $primaryKey = 'almacen_id';

    protected $fillable = [
        'almacen_id',
        'materia_prima_id',
        'cantidad_minima',
        'cantidad_maxima',
        'actual',
    ];

    public function almacen(){
        return $this->belongsTo('App\Models\Almacen');
    }
    public function materia_prima(){
        return $this->belongsTo('App\Models\MateriaPrima');
    }

}
