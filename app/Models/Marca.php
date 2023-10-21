<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];

    public function materia_prima() {
        return $this->hasMany('App\Models\MateriaPrima');
    }
}
