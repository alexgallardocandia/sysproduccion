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

Route::get('users','App\Http\Controllers\UserController@index')->name('users.index');
Route::get('users/create','App\Http\Controllers\UserController@create')->name('users.create');
Route::post('users','App\Http\Controllers\UserController@store')->name('users.store');
Route::get('users/{users}', 'App\Http\Controllers\UserController@show')->name('user.show');
Route::get('users/{users}/edit', 'App\Http\Controllers\UserController@edit')->name('user.edit');
Route::post('/',[App\Http\Controllers\LogController::class, 'login'])->name('login.post');

//Route::get('/index')->name('logados');


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
