<?php

namespace Database\Seeders;

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
            'persona_id'        => null
        ]);
    }
}