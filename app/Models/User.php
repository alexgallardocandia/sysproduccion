<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'email',
        'status',
        'password',
        'empleado_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function empleado() {
        return $this->belongsTo('App\Models\Empleado');
    }
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }
}
