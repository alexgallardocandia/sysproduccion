<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjusteStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'almacen_id',
        'user_id',
        'estado',
    ];

    public function almacen()
    {
        return $this->belongsTo('App\Models\Almacen');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function details()
    {
        return $this->hasMany('App\Models\AjusteStockDetalle');
    }
}
