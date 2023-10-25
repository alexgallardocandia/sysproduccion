<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index() {

        $marcas = Marca::get();

        return view('pages.compras.marcas.index', compact('marcas'));
    }
    
    public function create() {

        return view('pages.compras.marcas.create');
    }

    public function store(Request $request) {

        Marca::create([
            'nombre'       => strtoupper($request->nombre)
        ]);

        return redirect()->route('marcas.index')->with('success', 'Marca Creada');
    }

    public function show(Marca $marca) {

        return view('pages.compras.marcas.show', compact('marca'));
    }

    public function edit(Marca $marca) {

        return view('pages.compras.marcas.edit', compact('marca'));
    }

    public function update(Request $request) {

        $marca = Marca::find($request->marca_id);

        $marca->update([
            'nombre'       => strtoupper($request->nombre)
        ]);

        return redirect()->route('marcas.index')->with('success','Marca Editada');
    }

    public function destroy() {
        
        $marca = Marca::find(request()->marca_id);

        $marca->delete();

        return redirect()->route('marcas.index')->with('success','Marca Eliminada');    
    }
}
