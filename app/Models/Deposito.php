<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposito extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'descripcion',
        'sucursal_id'
    ];

    public function sucursal(){
        return $this->belongsTo('App\Models\Sucursal');
    }
}
