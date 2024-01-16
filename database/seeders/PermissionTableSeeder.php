<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('permissions')->truncate();

        DB::table('permissions')->insert([
            
            [
                'name'          => 'menu.referenciales',
                'display_name'  => 'Ver Menu Referenciales',
                'description'   => 'Menus',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'menu.configuraciones',
                'display_name'  => 'Ver Menu Configuraciones',
                'description'   => 'Menus',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'menu.compras',
                'display_name'  => 'Ver Menu Compras',
                'description'   => 'Menus',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'menu.produccion',
                'display_name'  => 'Ver Menu Produccion',
                'description'   => 'Menus',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'menu.ventas',
                'display_name'  => 'Ver Menu Ventas',
                'description'   => 'Menus',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'permisos.index',
                'display_name'  => 'Ver Permisos',
                'description'   => 'Permisos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'permisos.create',
                'display_name'  => 'Crear Permisos',
                'description'   => 'Permisos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'permisos.show',
                'display_name'  => 'Detalles Permisos',
                'description'   => 'Permisos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'permisos.edit',
                'display_name'  => 'Editar Permisos',
                'description'   => 'Permisos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'permisos.delete',
                'display_name'  => 'Eliminar Permisos',
                'description'   => 'Permisos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //usuarios
            [
                'name'          => 'users.index',
                'display_name'  => 'Ver Usuarios',
                'description'   => 'Usuarios',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'users.create',
                'display_name'  => 'Crear Usuarios',
                'description'   => 'Usuarios',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'users.show',
                'display_name'  => 'Detalles Usuarios',
                'description'   => 'Usuarios',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'users.edit',
                'display_name'  => 'Editar Usuarios',
                'description'   => 'Usuarios',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'users.delete',
                'display_name'  => 'Eliminar Usuarios',
                'description'   => 'Usuarios',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
