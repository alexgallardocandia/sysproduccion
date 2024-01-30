<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ci',
        'nombres',
        'apellidos',
        'direccion',
        'telefono',
        'email',
        'fecha_nacimiento',
        'civil_id',
        'imagen-empleado',
        'cargo_id',
        'sucursal_id',
        'estado',
    ];

    protected $appends = [ 'fullname' ];

    public function getFullnameAttribute() {
        return $this->attributes['nombres'] . ' ' .  $this->attributes['apellidos'];
    }

    public function civil(){
        return $this->belongsTo('App\Models\EstadoCivil');
    }
    public function cargo(){
        return $this->belongsTo('App\Models\Cargo');
    }
    public function Sucursal(){
        return $this->belongsTo('App\Models\Sucursal');
    }
}
