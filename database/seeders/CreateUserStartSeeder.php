<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\EstadoCivil;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUserStartSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'              => 'admin',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => null,
            'password'          => Hash::make('admin'),
            'status'            => true,
            'empleado_id'        => null
        ]);

        EstadoCivil::create([
            'descripcion'   => 'Soltero' 
        ]);
        EstadoCivil::create([
            'descripcion'   => 'Casado' 
        ]);

        Cargo::create([
            'descripcion'   => 'Administrador'
        ]);
        Sucursal::create([
            'descripcion'   => 'Central'
        ]);
    }
}