<?php

namespace App\Models;

use Carbon\Carbon;
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
    public function getCreatedAtAttribute() {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('d/m/Y H:i:s');
    }
    public function getUpdatedAtAttribute() {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['updated_at'])->format('d/m/Y H:i:s');
    }

}
