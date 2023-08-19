<?php

namespace App\Models;

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
        'tipo',
        'estado'
    ];
}