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
            //estados-civiles
            [
                'name'          => 'estados-civiles.index',
                'display_name'  => 'Ver Estados Civiles',
                'description'   => 'Estados Civiles',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'estados-civiles.create',
                'display_name'  => 'Crear Estados Civiles',
                'description'   => 'Estados Civiles',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'estados-civiles.show',
                'display_name'  => 'Detalles Estados Civiles',
                'description'   => 'Estados Civiles',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'estados-civiles.edit',
                'display_name'  => 'Editar Estados Civiles',
                'description'   => 'Estados Civiles',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'estados-civiles.delete',
                'display_name'  => 'Eliminar Estados Civiles',
                'description'   => 'Estados Civiles',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //cargos routes
            [
                'name'          => 'cargos.index',
                'display_name'  => 'Ver Cargos',
                'description'   => 'Cargos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'cargos.create',
                'display_name'  => 'Crear Cargos',
                'description'   => 'Cargos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'cargos.show',
                'display_name'  => 'Detalles Cargos',
                'description'   => 'Cargos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'cargos.edit',
                'display_name'  => 'Editar Cargos',
                'description'   => 'Cargos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'cargos.delete',
                'display_name'  => 'Eliminar Cargos',
                'description'   => 'Cargos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //categorias routes
            [
                'name'          => 'categorias.index',
                'display_name'  => 'Ver Categorias',
                'description'   => 'Categorias',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'categorias.create',
                'display_name'  => 'Crear Categorias',
                'description'   => 'Categorias',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'categorias.show',
                'display_name'  => 'Detalles Categorias',
                'description'   => 'Categorias',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'categorias.edit',
                'display_name'  => 'Editar Categorias',
                'description'   => 'Categorias',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'categorias.delete',
                'display_name'  => 'Eliminar Categorias',
                'description'   => 'Categorias',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //marcas routes
            [
                'name'          => 'marcas.index',
                'display_name'  => 'Ver Marcas',
                'description'   => 'Marcas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'marcas.create',
                'display_name'  => 'Crear Marcas',
                'description'   => 'Marcas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'marcas.show',
                'display_name'  => 'Detalles Marcas',
                'description'   => 'Marcas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'marcas.edit',
                'display_name'  => 'Editar Marcas',
                'description'   => 'Marcas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'marcas.delete',
                'display_name'  => 'Eliminar Marcas',
                'description'   => 'Marcas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //departamentos routes
            [
                'name'          => 'departamentos.index',
                'display_name'  => 'Ver Departamentos',
                'description'   => 'Departamentos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'departamentos.create',
                'display_name'  => 'Crear Departamentos',
                'description'   => 'Departamentos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'departamentos.show',
                'display_name'  => 'Detalles Departamentos',
                'description'   => 'Departamentos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'departamentos.edit',
                'display_name'  => 'Editar Departamentos',
                'description'   => 'Departamentos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'departamentos.delete',
                'display_name'  => 'Eliminar Departamentos',
                'description'   => 'Departamentos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //sucursales routes
            [
                'name'          => 'sucursales.index',
                'display_name'  => 'Ver Sucursales',
                'description'   => 'Sucursales',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'sucursales.create',
                'display_name'  => 'Crear Sucursales',
                'description'   => 'Sucursales',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'sucursales.show',
                'display_name'  => 'Detalles Sucursales',
                'description'   => 'Sucursales',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'sucursales.edit',
                'display_name'  => 'Editar Sucursales',
                'description'   => 'Sucursales',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'sucursales.delete',
                'display_name'  => 'Eliminar Sucursales',
                'description'   => 'Sucursales',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //ciudades routes
            [
                'name'          => 'ciudades.index',
                'display_name'  => 'Ver Ciudades',
                'description'   => 'Ciudades',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'ciudades.create',
                'display_name'  => 'Crear Ciudades',
                'description'   => 'Ciudades',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'ciudades.show',
                'display_name'  => 'Detalles Ciudades',
                'description'   => 'Ciudades',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'ciudades.edit',
                'display_name'  => 'Editar Ciudades',
                'description'   => 'Ciudades',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'ciudades.delete',
                'display_name'  => 'Eliminar Ciudades',
                'description'   => 'Ciudades',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //empleados routes
            [
                'name'          => 'empleados.index',
                'display_name'  => 'Ver Empleados',
                'description'   => 'Empleados',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'empleados.create',
                'display_name'  => 'Crear Empleados',
                'description'   => 'Empleados',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'empleados.show',
                'display_name'  => 'Detalles Empleados',
                'description'   => 'Empleados',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'empleados.edit',
                'display_name'  => 'Editar Empleados',
                'description'   => 'Empleados',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'empleados.delete',
                'display_name'  => 'Eliminar Empleados',
                'description'   => 'Empleados',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //despositos routes
            [
                'name'          => 'despositos.index',
                'display_name'  => 'Ver Depositos',
                'description'   => 'Depositos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'despositos.create',
                'display_name'  => 'Crear Depositos',
                'description'   => 'Depositos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'despositos.show',
                'display_name'  => 'Detalles Depositos',
                'description'   => 'Depositos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'despositos.edit',
                'display_name'  => 'Editar Depositos',
                'description'   => 'Depositos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'despositos.delete',
                'display_name'  => 'Eliminar Depositos',
                'description'   => 'Depositos',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //unidades-medidas routes
            [
                'name'          => 'unidades-medidas.index',
                'display_name'  => 'Ver Unidades Medidas',
                'description'   => 'Unidades Medidas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'unidades-medidas.create',
                'display_name'  => 'Crear Unidades Medidas',
                'description'   => 'Unidades Medidas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'unidades-medidas.show',
                'display_name'  => 'Detalles Unidades Medidas',
                'description'   => 'Unidades Medidas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'unidades-medidas.edit',
                'display_name'  => 'Editar Unidades Medidas',
                'description'   => 'Unidades Medidas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'unidades-medidas.delete',
                'display_name'  => 'Eliminar Unidades Medidas',
                'description'   => 'Unidades Medidas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //tipo-impuestos routes
            [
                'name'          => 'tipo-impuestos.index',
                'display_name'  => 'Ver Tipo Impuesto',
                'description'   => 'Tipo Impuesto',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'tipo-impuestos.create',
                'display_name'  => 'Crear Tipo Impuesto',
                'description'   => 'Tipo Impuesto',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'tipo-impuestos.show',
                'display_name'  => 'Detalles Tipo Impuesto',
                'description'   => 'Tipo Impuesto',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'tipo-impuestos.edit',
                'display_name'  => 'Editar Tipo Impuesto',
                'description'   => 'Tipo Impuesto',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'tipo-impuestos.delete',
                'display_name'  => 'Eliminar Tipo Impuesto',
                'description'   => 'Tipo Impuesto',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //timbrados routes
            [
                'name'          => 'timbrados.index',
                'display_name'  => 'Ver Timbrados',
                'description'   => 'Timbrados',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'timbrados.create',
                'display_name'  => 'Crear Timbrados',
                'description'   => 'Timbrados',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'timbrados.show',
                'display_name'  => 'Detalles Timbrados',
                'description'   => 'Timbrados',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'timbrados.edit',
                'display_name'  => 'Editar Timbrados',
                'description'   => 'Timbrados',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'timbrados.delete',
                'display_name'  => 'Eliminar Timbrados',
                'description'   => 'Timbrados',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //proveedores routes
            [
                'name'          => 'proveedores.index',
                'display_name'  => 'Ver Proveedores',
                'description'   => 'Proveedores',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'proveedores.create',
                'display_name'  => 'Crear Proveedores',
                'description'   => 'Proveedores',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'proveedores.show',
                'display_name'  => 'Detalles Proveedores',
                'description'   => 'Proveedores',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'proveedores.edit',
                'display_name'  => 'Editar Proveedores',
                'description'   => 'Proveedores',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'proveedores.delete',
                'display_name'  => 'Eliminar Proveedores',
                'description'   => 'Proveedores',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //materias-primas routes
            [
                'name'          => 'materias-primas.index',
                'display_name'  => 'Ver Materias Primas',
                'description'   => 'Materias Primas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'materias-primas.create',
                'display_name'  => 'Crear Materias Primas',
                'description'   => 'Materias Primas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'materias-primas.show',
                'display_name'  => 'Detalles Materias Primas',
                'description'   => 'Materias Primas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'materias-primas.edit',
                'display_name'  => 'Editar Materias Primas',
                'description'   => 'Materias Primas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'materias-primas.delete',
                'display_name'  => 'Eliminar Materias Primas',
                'description'   => 'Materias Primas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //pedidos-compras routes
            [
                'name'          => 'pedidos-compras.index',
                'display_name'  => 'Ver Pedidos Compras',
                'description'   => 'Pedidos Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'pedidos-compras.create',
                'display_name'  => 'Crear Pedidos Compras',
                'description'   => 'Pedidos Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'pedidos-compras.show',
                'display_name'  => 'Detalles Pedidos Compras',
                'description'   => 'Pedidos Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'pedidos-compras.edit',
                'display_name'  => 'Editar Pedidos Compras',
                'description'   => 'Pedidos Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'pedidos-compras.delete',
                'display_name'  => 'Eliminar Pedidos Compras',
                'description'   => 'Pedidos Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //presupuestos-compras routes
            [
                'name'          => 'presupuestos-compras.index',
                'display_name'  => 'Ver Presupuestos Compras',
                'description'   => 'Presupuestos Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'presupuestos-compras.create',
                'display_name'  => 'Crear Presupuestos Compras',
                'description'   => 'Presupuestos Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'presupuestos-compras.show',
                'display_name'  => 'Detalles Presupuestos Compras',
                'description'   => 'Presupuestos Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'presupuestos-compras.edit',
                'display_name'  => 'Editar Presupuestos Compras',
                'description'   => 'Presupuestos Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'presupuestos-compras.delete',
                'display_name'  => 'Eliminar Presupuestos Compras',
                'description'   => 'Presupuestos Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //orden-compras routes
            [
                'name'          => 'orden-compras.index',
                'display_name'  => 'Ver Orden Compras',
                'description'   => 'Orden Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'orden-compras.create',
                'display_name'  => 'Crear Orden Compras',
                'description'   => 'Orden Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'orden-compras.show',
                'display_name'  => 'Detalles Orden Compras',
                'description'   => 'Orden Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'orden-compras.edit',
                'display_name'  => 'Editar Orden Compras',
                'description'   => 'Orden Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'orden-compras.delete',
                'display_name'  => 'Eliminar Orden Compras',
                'description'   => 'Orden Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'orden-compras.aprove',
                'display_name'  => 'Aprobar Orden Compras',
                'description'   => 'Orden Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //compras routes
            [
                'name'          => 'compras.index',
                'display_name'  => 'Ver Compras',
                'description'   => 'Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'compras.create',
                'display_name'  => 'Crear Compras',
                'description'   => 'Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'compras.show',
                'display_name'  => 'Detalles Compras',
                'description'   => 'Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'compras.edit',
                'display_name'  => 'Editar Compras',
                'description'   => 'Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'compras.delete',
                'display_name'  => 'Eliminar Compras',
                'description'   => 'Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'libro-compras.index',
                'display_name'  => 'Ver Libro Compras',
                'description'   => 'Compras',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
             //Ajuste Stock routes
             [
                'name'          => 'ajuste-stocks.index',
                'display_name'  => 'Ver Ajuste Stocks',
                'description'   => 'Ajuste Stocks',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'ajuste-stocks.create',
                'display_name'  => 'Crear Ajuste Stocks',
                'description'   => 'Ajuste Stocks',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'ajuste-stocks.show',
                'display_name'  => 'Detalles Ajuste Stocks',
                'description'   => 'Ajuste Stocks',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'ajuste-stocks.edit',
                'display_name'  => 'Editar Ajuste Stocks',
                'description'   => 'Ajuste Stocks',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'ajuste-stocks.delete',
                'display_name'  => 'Eliminar Ajuste Stocks',
                'description'   => 'Ajuste Stocks',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //stocks routes
            [
                'name'          => 'stocks.index',
                'display_name'  => 'Ver Stock',
                'description'   => 'Stock',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'stocks.create',
                'display_name'  => 'Crear Stock',
                'description'   => 'Stock',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'stocks.show',
                'display_name'  => 'Detalles Stock',
                'description'   => 'Stock',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'stocks.edit',
                'display_name'  => 'Editar Stock',
                'description'   => 'Stock',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'stocks.delete',
                'display_name'  => 'Eliminar Stock',
                'description'   => 'Stock',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //NotaCreditoMotivos routes
            [
                'name'          => 'nota-motivos.index',
                'display_name'  => 'Ver Nota Credito Motivo',
                'description'   => 'Nota Credito Motivo',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'nota-motivos.create',
                'display_name'  => 'Crear Nota Credito Motivo',
                'description'   => 'Nota Credito Motivo',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'nota-motivos.show',
                'display_name'  => 'Detalles Nota Credito Motivo',
                'description'   => 'Nota Credito Motivo',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'nota-motivos.edit',
                'display_name'  => 'Editar Nota Credito Motivo',
                'description'   => 'Nota Credito Motivo',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'nota-motivos.delete',
                'display_name'  => 'Eliminar Nota Credito Motivo',
                'description'   => 'Nota Credito Motivo',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            //NotaCreditos routes
            [
                'name'          => 'nota-creditos.index',
                'display_name'  => 'Ver Nota Credito',
                'description'   => 'Nota Credito',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'nota-creditos.create',
                'display_name'  => 'Crear Nota Credito',
                'description'   => 'Nota Credito',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'nota-creditos.show',
                'display_name'  => 'Detalles Nota Credito',
                'description'   => 'Nota Credito',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'nota-creditos.edit',
                'display_name'  => 'Editar Nota Credito',
                'description'   => 'Nota Credito',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'nota-creditos.delete',
                'display_name'  => 'Eliminar Nota Credito',
                'description'   => 'Nota Credito',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
