<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sucursales';

    protected $fillable = [
        'descripcion',
        'deleted_at',
        'created_at',
        'updated_at'
    ];    

    public function persona(){
        return $this->hasMany('App\Models\Persona');
    }
}
