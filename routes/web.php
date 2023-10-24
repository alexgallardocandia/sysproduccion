<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\LogController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });
// Route::get('/home',[App\Http\Controllers\PrincipalController::class, 'index'])->name('home');

Route::middleware(['guest'])->group(function () {
    Route::get('/','LogController@index')->name('login');
    Route::post('acceso','LogController@login')->name('acceso');
    // Route::get('/home','PrincipalController@index')->name('home');

    // Route::get('login', 'LoginController@index')->name('login');
    // Route::post('login', 'LoginController@login')->name('login.post');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'PrincipalController@index')->name('home'); // Asegúrate de que el controlador y el método sean correctos

    //users routes
    Route::get('users','UserController@index')->name('users.index');
    Route::get('users/create','UserController@create')->name('users.create');
    Route::post('users','UserController@store')->name('users.store');
    Route::get('users/{users}', 'UserController@show')->name('user.show');
    Route::get('users/{users}/edit', 'UserController@edit')->name('user.edit');
    Route::put('users', 'UserController@update')->name('user.update');
    Route::delete('users', 'UserController@destroy')->name('user.delete');
    //estados_civiles routes
    Route::get('estados-civiles','EstadoCivilController@index')->name('estados-civiles.index');
    Route::get('estados-civiles/create','EstadoCivilController@create')->name('estados-civiles.create');
    Route::post('estados-civiles','EstadoCivilController@store')->name('estados-civiles.store');
    Route::get('estados-civiles/{estado_id}', 'EstadoCivilController@show')->name('estados-civiles.show');
    Route::get('estados-civiles/{estado_id}/edit', 'EstadoCivilController@edit')->name('estados-civiles.edit');
    Route::put('estados-civiles', 'EstadoCivilController@update')->name('estados-civiles.update');
    Route::delete('estados-civiles', 'EstadoCivilController@destroy')->name('estados-civiles.delete');
    //cargos routes
    Route::get('cargos','CargoController@index')->name('cargos.index');
    Route::get('cargos/create','CargoController@create')->name('cargos.create');
    Route::post('cargos','CargoController@store')->name('cargos.store');
    Route::get('cargos/{estado_id}', 'CargoController@show')->name('cargos.show');
    Route::get('cargos/{estado_id}/edit', 'CargoController@edit')->name('cargos.edit');
    Route::put('cargos', 'CargoController@update')->name('cargos.update');
    Route::delete('cargos', 'CargoController@destroy')->name('cargos.delete');
    //Categorias routes
    Route::get('categorias','CategoriaController@index')->name('categorias.index');
    Route::get('categorias/create','CategoriaController@create')->name('categorias.create');
    Route::post('categorias','CategoriaController@store')->name('categorias.store');
    Route::get('categorias/{categoria_id}', 'CategoriaController@show')->name('categorias.show');
    Route::get('categorias/{categoria_id}/edit', 'CategoriaController@edit')->name('categorias.edit');
    Route::put('categorias', 'CategoriaController@update')->name('categorias.update');
    Route::delete('categorias', 'CategoriaController@destroy')->name('categorias.delete');
    //Marcas routes
    Route::get('marcas','MarcaController@index')->name('marcas.index');
    Route::get('marcas/create','MarcaController@create')->name('marcas.create');
    Route::post('marcas','MarcaController@store')->name('marcas.store');
    Route::get('marcas/{marca}', 'MarcaController@show')->name('marcas.show');
    Route::get('marcas/{marca}/edit', 'MarcaController@edit')->name('marcas.edit');
    Route::put('marcas', 'MarcaController@update')->name('marcas.update');
    Route::delete('marcas', 'MarcaController@destroy')->name('marcas.delete');
    //Departamentos routes
    Route::get('departamentos','DepartamentoController@index')->name('departamentos.index');
    Route::get('departamentos/create','DepartamentoController@create')->name('departamentos.create');
    Route::post('departamentos','DepartamentoController@store')->name('departamentos.store');
    Route::get('departamentos/{departamento_id}', 'DepartamentoController@show')->name('departamentos.show');
    Route::get('departamentos/{departamento_id}/edit', 'DepartamentoController@edit')->name('departamentos.edit');
    Route::put('departamentos', 'DepartamentoController@update')->name('departamentos.update');
    Route::delete('departamentos', 'DepartamentoController@destroy')->name('departamentos.delete');
    //sucursales routes
    Route::get('sucursales','SucursalController@index')->name('sucursales.index');
    Route::get('sucursales/create','SucursalController@create')->name('sucursales.create');
    Route::post('sucursales','SucursalController@store')->name('sucursales.store');
    Route::get('sucursales/{sucursal_id}', 'SucursalController@show')->name('sucursales.show');
    Route::get('sucursales/{sucursal_id}/edit', 'SucursalController@edit')->name('sucursales.edit');
    Route::put('sucursales', 'SucursalController@update')->name('sucursales.update');
    Route::delete('sucursales', 'SucursalController@destroy')->name('sucursales.delete');
    //ciudades routes
    Route::get('ciudades','CiudadController@index')->name('ciudades.index');
    Route::get('ciudades/create','CiudadController@create')->name('ciudades.create');
    Route::post('ciudades','CiudadController@store')->name('ciudades.store');
    Route::get('ciudades/{sucursal_id}', 'CiudadController@show')->name('ciudades.show');
    Route::get('ciudades/{sucursal_id}/edit', 'CiudadController@edit')->name('ciudades.edit');
    Route::put('ciudades', 'CiudadController@update')->name('ciudades.update');
    Route::delete('ciudades', 'CiudadController@destroy')->name('ciudades.delete');
    //personas routes
    Route::get('personas','PersonaController@index')->name('personas.index');
    Route::get('personas/create','PersonaController@create')->name('personas.create');
    Route::post('personas','PersonaController@store')->name('personas.store');
    Route::get('personas/{persona_id}', 'PersonaController@show')->name('personas.show');
    Route::get('personas/{persona_id}/edit', 'PersonaController@edit')->name('personas.edit');
    Route::put('personas', 'PersonaController@update')->name('personas.update');
    Route::delete('personas', 'PersonaController@destroy')->name('personas.delete');
    //depositos routes
    Route::get('depositos','DepositoController@index')->name('depositos.index');
    Route::get('depositos/create','DepositoController@create')->name('depositos.create');
    Route::post('depositos','DepositoController@store')->name('depositos.store');
    Route::get('depositos/{deposito_id}', 'DepositoController@show')->name('depositos.show');
    Route::get('depositos/{deposito_id}/edit', 'DepositoController@edit')->name('depositos.edit');
    Route::put('depositos', 'DepositoController@update')->name('depositos.update');
    Route::delete('depositos', 'DepositoController@destroy')->name('depositos.delete');
    //unidades-medidas routes
    Route::get('unidades-medidas','UnidadMedidaController@index')->name('unidades-medidas.index');
    Route::get('unidades-medidas/create','UnidadMedidaController@create')->name('unidades-medidas.create');
    Route::post('unidades-medidas','UnidadMedidaController@store')->name('unidades-medidas.store');
    Route::get('unidades-medidas/{unidad_id}', 'UnidadMedidaController@show')->name('unidades-medidas.show');
    Route::get('unidades-medidas/{unidad_id}/edit', 'UnidadMedidaController@edit')->name('unidades-medidas.edit');
    Route::put('unidades-medidas', 'UnidadMedidaController@update')->name('unidades-medidas.update');
    Route::delete('unidades-medidas', 'UnidadMedidaController@destroy')->name('unidades-medidas.delete');
    //tipos-impuestos routes
    Route::get('tipos-impuestos','TipoImpuestoController@index')->name('tipos-impuestos.index');
    Route::get('tipos-impuestos/create','TipoImpuestoController@create')->name('tipos-impuestos.create');
    Route::post('tipos-impuestos','TipoImpuestoController@store')->name('tipos-impuestos.store');
    Route::get('tipos-impuestos/{tipo_id}', 'TipoImpuestoController@show')->name('tipos-impuestos.show');
    Route::get('tipos-impuestos/{tipo_id}/edit', 'TipoImpuestoController@edit')->name('tipos-impuestos.edit');
    Route::put('tipos-impuestos', 'TipoImpuestoController@update')->name('tipos-impuestos.update');
    Route::delete('tipos-impuestos', 'TipoImpuestoController@destroy')->name('tipos-impuestos.delete');
    //timbrados routes
    Route::get('timbrados','TimbradoController@index')->name('timbrados.index');
    Route::get('timbrados/create','TimbradoController@create')->name('timbrados.create');
    Route::post('timbrados','TimbradoController@store')->name('timbrados.store');
    Route::get('timbrados/{timbrado_id}', 'TimbradoController@show')->name('timbrados.show');
    Route::get('timbrados/{timbrado_id}/edit', 'TimbradoController@edit')->name('timbrados.edit');
    Route::put('timbrados', 'TimbradoController@update')->name('timbrados.update');
    Route::delete('timbrados', 'TimbradoController@destroy')->name('timbrados.delete');
    //proveedores routes
    Route::get('proveedores','ProveedorController@index')->name('proveedores.index');
    Route::get('proveedores/create','ProveedorController@create')->name('proveedores.create');
    Route::post('proveedores','ProveedorController@store')->name('proveedores.store');
    Route::get('proveedores/{proveedor_id}', 'ProveedorController@show')->name('proveedores.show');
    Route::get('proveedores/{proveedor_id}/edit', 'ProveedorController@edit')->name('proveedores.edit');
    Route::put('proveedores', 'ProveedorController@update')->name('proveedores.update');
    Route::delete('proveedores', 'ProveedorController@destroy')->name('proveedores.delete');
    //materias-primas routes
    Route::get('materias-primas','MateriaPrimaController@index')->name('materias-primas.index');
    Route::get('materias-primas/create','MateriaPrimaController@create')->name('materias-primas.create');
    Route::post('materias-primas','MateriaPrimaController@store')->name('materias-primas.store');
    Route::get('materias-primas/{materia_id}', 'MateriaPrimaController@show')->name('materias-primas.show');
    Route::get('materias-primas/{materia_id}/edit', 'MateriaPrimaController@edit')->name('materias-primas.edit');
    Route::put('materias-primas', 'MateriaPrimaController@update')->name('materias-primas.update');
    Route::delete('materias-primas', 'MateriaPrimaController@destroy')->name('materias-primas.delete');
    //pedidos-compras routes
    Route::get('pedidos-compras','PedidoCompraController@index')->name('pedidos-compras.index');
    Route::get('pedidos-compras/create','PedidoCompraController@create')->name('pedidos-compras.create');
    Route::post('pedidos-compras','PedidoCompraController@store')->name('pedidos-compras.store');
    Route::get('pedidos-compras/{pedido_id}', 'PedidoCompraController@show')->name('pedidos-compras.show');
    Route::get('pedidos-compras/{pedido_id}/edit', 'PedidoCompraController@edit')->name('pedidos-compras.edit');
    Route::put('pedidos-compras', 'PedidoCompraController@update')->name('pedidos-compras.update');
    Route::delete('pedidos-compras', 'PedidoCompraController@destroy')->name('pedidos-compras.delete');
    //AJAX
    Route::post('pedidos-compras/ajax-attributes', 'PedidoCompraController@ajax_attributes')->name('pedidos-compras.ajax_attributes');
    //presupuestos-compras routes
    Route::get('presupuestos-compras','PresupuestoCompraController@index')->name('presupuestos-compras.index');
    Route::get('presupuestos-compras/create','PresupuestoCompraController@create')->name('presupuestos-compras.create');
    Route::post('presupuestos-compras','PresupuestoCompraController@store')->name('presupuestos-compras.store');
    Route::get('presupuestos-compras/{presupuesto_id}', 'PresupuestoCompraController@show')->name('presupuestos-compras.show');
    Route::get('presupuestos-compras/{presupuesto_id}/edit', 'PresupuestoCompraController@edit')->name('presupuestos-compras.edit');
    Route::put('presupuestos-compras', 'PresupuestoCompraController@update')->name('presupuestos-compras.update');
    Route::delete('presupuestos-compras', 'PresupuestoCompraController@destroy')->name('presupuestos-compras.delete');

});

Route::get('logout', 'LogController@logout')->name('logout');


//Route::get('/index')->name('logados');

// Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//logs
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
