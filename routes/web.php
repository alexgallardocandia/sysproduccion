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
Route::get('personas/{sucursal_id}', 'App\Http\Controllers\PersonaController@show')->name('personas.show');
Route::get('personas/{sucursal_id}/edit', 'App\Http\Controllers\PersonaController@edit')->name('personas.edit');
Route::put('personas', 'App\Http\Controllers\PersonaController@update')->name('personas.update');
Route::delete('personas', 'App\Http\Controllers\PersonaController@destroy')->name('personas.delete');

Route::post('/',[App\Http\Controllers\LogController::class, 'login'])->name('login.post');

//Route::get('/index')->name('logados');


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
