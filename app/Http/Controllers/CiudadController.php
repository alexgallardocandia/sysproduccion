<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use Illuminate\Contracts\Container\CircularDependencyException;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    
    public function index()
    {
        $ciudades = Ciudad::get();

        return view('pages.ciudades.index', compact('ciudades'));
    }

    public function create(){
        return view('pages.ciudades.create');
    }

    public function store(Request $request)
    {
        Ciudad::create([
            'descripcion' => strtoupper($request->descripcion)
        ]);
        
        return redirect()->route('ciudades.index')->with('success','Ciudad creada');    
    }

  
    public function show($ciudad_id)
    {
        $ciudad = Ciudad::find($ciudad_id);

        return view('pages.ciudades.show', compact('ciudad'));
    }

    public function edit($ciudad_id){
        $ciudad = Ciudad::find($ciudad_id);

        return view('pages.ciudades.edit', compact('ciudad'));

    }

    public function update(Request $request, Ciudad $ciudad)
    {
        $ciudad = Ciudad::find($request->ciudad_id);

        $ciudad->update([
            'descripcion' => strtoupper($request->descripcion)            
        ]);

        return redirect()->route('ciudades.index')->with('warning','Ciudad editada');
    }

   
    public function destroy(Request $request)
    {
        $ciudad = Ciudad::find($request->ciudad_id);

        $ciudad->delete();

        return redirect()->route('ciudades.index')->with('danger','Ciudad eliminada');
    }
}