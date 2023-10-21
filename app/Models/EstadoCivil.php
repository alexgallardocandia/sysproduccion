<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoCivil extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'estado_civiles';

    protected $fillable = [
        'descripcion',
        'created_at',
        'updated_at'
    ];

    public function persona(){
        return $this->hasMany('App\Models\Persona');
    }
    
}

