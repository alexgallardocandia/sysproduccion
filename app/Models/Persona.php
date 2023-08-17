<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'personas';

    protected $fillable = [
        'nombres',
        'apellidos',
        'direccion',
        'telefono',
        'email',
        'fecha_nacimiento',
        'civil_id',
        'cargo_id',
        'sucursal_id',
        'ciudad_id',
        'ci'
    ];

    public function civil(){
        return $this->belongsTo('App\Models\EstadoCivil');
    }
    public function cargo(){
        return $this->belongsTo('App\Models\Cargo');
    }
    public function Ciudad(){
        return $this->belongsTo('App\Models\Ciudad');
    }
    public function Sucursal(){
        return $this->belongsTo('App\Models\Sucursal');
    }
}
