<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
 
    public function index()
    {
        $depositos = Almacen::get();

        return view('pages.depositos.index', compact('depositos'));
    }

    public function create(){
        $sucursales = Sucursal::get();
        return view('pages.depositos.create', compact('sucursales'));
    }

    public function store(Request $request)
    {
        Almacen::create([
            'descripcion'   => strtoupper($request->descripcion),
            'sucursal_id'   => $request->sucursal_id
        ]);

        return redirect()->route('depositos.index')->with('success','Desposito Creado');
    } 

    public function show($deposito_id)
    {
        $deposito = Almacen::find($deposito_id);
        
        return view('pages.depositos.show',compact('deposito'));
    }

    public function edit($deposito_id){
        $deposito = Almacen::find($deposito_id);
        $sucursales = Sucursal::get();
        return view('pages.depositos.edit',compact('deposito','sucursales'));
    }

    public function update(Request $request)
    {
        $deposito = Almacen::find($request->deposito_id);
        $deposito->update([
            'descripcion' => strtoupper($request->descripcion),
            'sucursal_id' => $request->sucursal_id
        ]);

        return redirect()->route('depositos.index')->with('warning','Deposito Modificado');
    }

    public function destroy()
    {
        $deposito = Almacen::find(request()->deposito_id);
        $deposito->delete();
        
        return redirect()->route('depositos.index')->with('danger','Deposito Eliminado');
    }
}
