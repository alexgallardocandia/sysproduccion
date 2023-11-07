<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'descripcion',
        'departamento_id'
    ];
    
    public function empleado(){
        return $this->hasMany('App\Models\Empleado');
    }
    public function departamento() {
        return $this->belongsTo('App\Models\Departamento');
    }
}
