<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::get();

        return view('pages.compras.categorias.index', compact('categorias'));
    }
    
    public function create(){
        return view('pages.compras.categorias.create');
    }

    public function store(Request $request)
    {
        Categoria::create([
            'nombre'       => strtoupper($request->nombre)
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoria Creada');
    }

    public function show($categoria_id)
    {
        $categoria = Categoria::find($categoria_id);        
        return view('pages.compras.categorias.show', compact('categoria'));
    }

    public function edit($categoria_id){        
        $categoria         = Categoria::find($categoria_id);

        return view('pages.compras.categorias.edit', compact('categoria'));
    }

    public function update(Request $request)
    {
        $categoria = Categoria::find($request->categoria_id);

        $categoria->update([
            'nombre'       => strtoupper($request->nombre)
        ]);

        return redirect()->route('categorias.index')->with('success','Categoria Editada');
    }

    public function destroy()
    {
        $categoria = Categoria::find(request()->categoria_id);

        $categoria->delete();

        return redirect()->route('categorias.index')->with('success','Categoria Eliminada');    
    }
}
