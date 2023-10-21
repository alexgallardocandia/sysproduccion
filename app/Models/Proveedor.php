<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'proveedores';

    protected $fillable =[
        'razon_social',
        'ruc',
        'telefono',
        'direccion',
        'email',
        'ciudad_id',
    ];

    public function ciudad(){
        return $this->belongsTo('App\Models\Ciudad');
    }
}
