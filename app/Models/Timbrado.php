<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timbrado extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'numero',
        'fecha_emision',
        'fecha_vencimiento',
        'estado'
    ];

    public function getFechaEmisionAttribute() {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha_emision'])->format('d/m/Y');
    }
    public function getFechaVencimientoAttribute() {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha_vencimiento'])->format('d/m/Y');
    }
}
