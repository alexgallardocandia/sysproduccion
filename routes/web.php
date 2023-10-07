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

Route::get('/',[App\Http\Controllers\LogController::class, 'index']);
Route::get('/home',[App\Http\Controllers\PrincipalController::class, 'index'])->name('home');
//users routes
Route::get('users','App\Http\Controllers\UserController@index')->name('users.index');
Route::get('users/create','App\Http\Controllers\UserController@create')->name('users.create');
Route::post('users','App\Http\Controllers\UserController@store')->name('users.store');
Route::get('users/{users}', 'App\Http\Controllers\UserController@show')->name('user.show');
Route::get('users/{users}/edit', 'App\Http\Controllers\UserController@edit')->name('user.edit');
Route::put('users', 'App\Http\Controllers\UserController@update')->name('user.update');
Route::delete('users', 'App\Http\Controllers\UserController@destroy')->name('user.delete');
//estados_civiles routes
Route::get('estados-civiles','App\Http\Controllers\EstadoCivilController@index')->name('estados-civiles.index');
Route::get('estados-civiles/create','App\Http\Controllers\EstadoCivilController@create')->name('estados-civiles.create');
Route::post('estados-civiles','App\Http\Controllers\EstadoCivilController@store')->name('estados-civiles.store');
Route::get('estados-civiles/{estado_id}', 'App\Http\Controllers\EstadoCivilController@show')->name('estados-civiles.show');
Route::get('estados-civiles/{estado_id}/edit', 'App\Http\Controllers\EstadoCivilController@edit')->name('estados-civiles.edit');
Route::put('estados-civiles', 'App\Http\Controllers\EstadoCivilController@update')->name('estados-civiles.update');
Route::delete('estados-civiles', 'App\Http\Controllers\EstadoCivilController@destroy')->name('estados-civiles.delete');
//cargos routes
Route::get('cargos','App\Http\Controllers\CargoController@index')->name('cargos.index');
Route::get('cargos/create','App\Http\Controllers\CargoController@create')->name('cargos.create');
Route::post('cargos','App\Http\Controllers\CargoController@store')->name('cargos.store');
Route::get('cargos/{estado_id}', 'App\Http\Controllers\CargoController@show')->name('cargos.show');
Route::get('cargos/{estado_id}/edit', 'App\Http\Controllers\CargoController@edit')->name('cargos.edit');
Route::put('cargos', 'App\Http\Controllers\CargoController@update')->name('cargos.update');
Route::delete('cargos', 'App\Http\Controllers\CargoController@destroy')->name('cargos.delete');
//sucursales routes
Route::get('sucursales','App\Http\Controllers\SucursalController@index')->name('sucursales.index');
Route::get('sucursales/create','App\Http\Controllers\SucursalController@create')->name('sucursales.create');
Route::post('sucursales','App\Http\Controllers\SucursalController@store')->name('sucursales.store');
Route::get('sucursales/{sucursal_id}', 'App\Http\Controllers\SucursalController@show')->name('sucursales.show');
Route::get('sucursales/{sucursal_id}/edit', 'App\Http\Controllers\SucursalController@edit')->name('sucursales.edit');
Route::put('sucursales', 'App\Http\Controllers\SucursalController@update')->name('sucursales.update');
Route::delete('sucursales', 'App\Http\Controllers\SucursalController@destroy')->name('sucursales.delete');
//ciudades routes
Route::get('ciudades','App\Http\Controllers\CiudadController@index')->name('ciudades.index');
Route::get('ciudades/create','App\Http\Controllers\CiudadController@create')->name('ciudades.create');
Route::post('ciudades','App\Http\Controllers\CiudadController@store')->name('ciudades.store');
Route::get('ciudades/{sucursal_id}', 'App\Http\Controllers\CiudadController@show')->name('ciudades.show');
Route::get('ciudades/{sucursal_id}/edit', 'App\Http\Controllers\CiudadController@edit')->name('ciudades.edit');
Route::put('ciudades', 'App\Http\Controllers\CiudadController@update')->name('ciudades.update');
Route::delete('ciudades', 'App\Http\Controllers\CiudadController@destroy')->name('ciudades.delete');
//personas routes
Route::get('personas','App\Http\Controllers\PersonaController@index')->name('personas.index');
Route::get('personas/create','App\Http\Controllers\PersonaController@create')->name('personas.create');
Route::post('personas','App\Http\Controllers\PersonaController@store')->name('personas.store');
Route::get('personas/{persona_id}', 'App\Http\Controllers\PersonaController@show')->name('personas.show');
Route::get('personas/{persona_id}/edit', 'App\Http\Controllers\PersonaController@edit')->name('personas.edit');
Route::put('personas', 'App\Http\Controllers\PersonaController@update')->name('personas.update');
Route::delete('personas', 'App\Http\Controllers\PersonaController@destroy')->name('personas.delete');
//depositos routes
Route::get('depositos','App\Http\Controllers\DepositoController@index')->name('depositos.index');
Route::get('depositos/create','App\Http\Controllers\DepositoController@create')->name('depositos.create');
Route::post('depositos','App\Http\Controllers\DepositoController@store')->name('depositos.store');
Route::get('depositos/{deposito_id}', 'App\Http\Controllers\DepositoController@show')->name('depositos.show');
Route::get('depositos/{deposito_id}/edit', 'App\Http\Controllers\DepositoController@edit')->name('depositos.edit');
Route::put('depositos', 'App\Http\Controllers\DepositoController@update')->name('depositos.update');
Route::delete('depositos', 'App\Http\Controllers\DepositoController@destroy')->name('depositos.delete');
Route::post('/',[App\Http\Controllers\LogController::class, 'login'])->name('login.post');
//unidades-medidas routes
Route::get('unidades-medidas','App\Http\Controllers\UnidadMedidaController@index')->name('unidades-medidas.index');
Route::get('unidades-medidas/create','App\Http\Controllers\UnidadMedidaController@create')->name('unidades-medidas.create');
Route::post('unidades-medidas','App\Http\Controllers\UnidadMedidaController@store')->name('unidades-medidas.store');
Route::get('unidades-medidas/{unidad_id}', 'App\Http\Controllers\UnidadMedidaController@show')->name('unidades-medidas.show');
Route::get('unidades-medidas/{unidad_id}/edit', 'App\Http\Controllers\UnidadMedidaController@edit')->name('unidades-medidas.edit');
Route::put('unidades-medidas', 'App\Http\Controllers\UnidadMedidaController@update')->name('unidades-medidas.update');
Route::delete('unidades-medidas', 'App\Http\Controllers\UnidadMedidaController@destroy')->name('unidades-medidas.delete');
//tipos-impuestos routes
Route::get('tipos-impuestos','App\Http\Controllers\TipoImpuestoController@index')->name('tipos-impuestos.index');
Route::get('tipos-impuestos/create','App\Http\Controllers\TipoImpuestoController@create')->name('tipos-impuestos.create');
Route::post('tipos-impuestos','App\Http\Controllers\TipoImpuestoController@store')->name('tipos-impuestos.store');
Route::get('tipos-impuestos/{tipo_id}', 'App\Http\Controllers\TipoImpuestoController@show')->name('tipos-impuestos.show');
Route::get('tipos-impuestos/{tipo_id}/edit', 'App\Http\Controllers\TipoImpuestoController@edit')->name('tipos-impuestos.edit');
Route::put('tipos-impuestos', 'App\Http\Controllers\TipoImpuestoController@update')->name('tipos-impuestos.update');
Route::delete('tipos-impuestos', 'App\Http\Controllers\TipoImpuestoController@destroy')->name('tipos-impuestos.delete');
//timbrados routes
Route::get('timbrados','App\Http\Controllers\TimbradoController@index')->name('timbrados.index');
Route::get('timbrados/create','App\Http\Controllers\TimbradoController@create')->name('timbrados.create');
Route::post('timbrados','App\Http\Controllers\TimbradoController@store')->name('timbrados.store');
Route::get('timbrados/{timbrado_id}', 'App\Http\Controllers\TimbradoController@show')->name('timbrados.show');
Route::get('timbrados/{timbrado_id}/edit', 'App\Http\Controllers\TimbradoController@edit')->name('timbrados.edit');
Route::put('timbrados', 'App\Http\Controllers\TimbradoController@update')->name('timbrados.update');
Route::delete('timbrados', 'App\Http\Controllers\TimbradoController@destroy')->name('timbrados.delete');
//proveedores routes
Route::get('proveedores','App\Http\Controllers\ProveedorController@index')->name('proveedores.index');
Route::get('proveedores/create','App\Http\Controllers\ProveedorController@create')->name('proveedores.create');
Route::post('proveedores','App\Http\Controllers\ProveedorController@store')->name('proveedores.store');
Route::get('proveedores/{proveedor_id}', 'App\Http\Controllers\ProveedorController@show')->name('proveedores.show');
Route::get('proveedores/{proveedor_id}/edit', 'App\Http\Controllers\ProveedorController@edit')->name('proveedores.edit');
Route::put('proveedores', 'App\Http\Controllers\ProveedorController@update')->name('proveedores.update');
Route::delete('proveedores', 'App\Http\Controllers\ProveedorController@destroy')->name('proveedores.delete');
//materias-primas routes
Route::get('materias-primas','App\Http\Controllers\MateriaPrimaController@index')->name('materias-primas.index');
Route::get('materias-primas/create','App\Http\Controllers\MateriaPrimaController@create')->name('materias-primas.create');
Route::post('materias-primas','App\Http\Controllers\MateriaPrimaController@store')->name('materias-primas.store');
Route::get('materias-primas/{materia_id}', 'App\Http\Controllers\MateriaPrimaController@show')->name('materias-primas.show');
Route::get('materias-primas/{materia_id}/edit', 'App\Http\Controllers\MateriaPrimaController@edit')->name('materias-primas.edit');
Route::put('materias-primas', 'App\Http\Controllers\MateriaPrimaController@update')->name('materias-primas.update');
Route::delete('materias-primas', 'App\Http\Controllers\MateriaPrimaController@destroy')->name('materias-primas.delete');
//pedidos-compras routes
Route::get('pedidos-compras','App\Http\Controllers\PedidoCompraController@index')->name('pedidos-compras.index');
Route::get('pedidos-compras/create','App\Http\Controllers\PedidoCompraController@create')->name('pedidos-compras.create');
Route::post('pedidos-compras','App\Http\Controllers\PedidoCompraController@store')->name('pedidos-compras.store');
Route::get('pedidos-compras/{pedido_id}', 'App\Http\Controllers\PedidoCompraController@show')->name('pedidos-compras.show');
Route::get('pedidos-compras/{pedido_id}/edit', 'App\Http\Controllers\PedidoCompraController@edit')->name('pedidos-compras.edit');
Route::put('pedidos-compras', 'App\Http\Controllers\PedidoCompraController@update')->name('pedidos-compras.update');
Route::delete('pedidos-compras', 'App\Http\Controllers\PedidoCompraController@destroy')->name('pedidos-compras.delete');
//presupuestos-compras routes
Route::get('presupuestos-compras','App\Http\Controllers\PresupuestoCompraController@index')->name('presupuestos-compras.index');
Route::get('presupuestos-compras/create','App\Http\Controllers\PresupuestoCompraController@create')->name('presupuestos-compras.create');
Route::post('presupuestos-compras','App\Http\Controllers\PresupuestoCompraController@store')->name('presupuestos-compras.store');
Route::get('presupuestos-compras/{pedido_id}', 'App\Http\Controllers\PresupuestoCompraController@show')->name('presupuestos-compras.show');
Route::get('presupuestos-compras/{pedido_id}/edit', 'App\Http\Controllers\PresupuestoCompraController@edit')->name('presupuestos-compras.edit');
Route::put('presupuestos-compras', 'App\Http\Controllers\PresupuestoCompraController@update')->name('presupuestos-compras.update');
Route::delete('presupuestos-compras', 'App\Http\Controllers\PresupuestoCompraController@destroy')->name('presupuestos-compras.delete');
Route::post('/',[App\Http\Controllers\LogController::class, 'login'])->name('login.post');

//Route::get('/index')->name('logados');


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
