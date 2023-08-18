<?php

namespace App\Http\Controllers;

use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class UnidadMedidaController extends Controller
{
    
    public function index()
    {
        $unidades = UnidadMedida::get();
        return view('pages.unidades-medidas.index', compact('unidades'));
    }

    public function create(){
        return view('pages.unidades-medidas.create');
    }

    public function store(Request $request)
    {
        UnidadMedida::create([
            'descripcion'   => strtoupper($request->descripcion),
            'signo'         => strtoupper($request->signo)
        ]);

        return redirect()->route('unidades-medidas.index')->with('success','Unidad de medida creada');
    }

    public function show($unidad_id)
    {
        $unidad = UnidadMedida::find($unidad_id);

        return view('pages.unidades-medidas.show', compact('unidad'));
    }

    public function edit($unidad_id){
        $unidad = UnidadMedida::find($unidad_id);

        return view('pages.unidades-medidas.edit', compact('unidad'));
    }

    public function update(Request $request)
    {
        $unidad = UnidadMedida::find($request->unidad_id);

        $unidad->update([
            'descripcion'   => strtoupper($request->descripcion),
            'signo'         => strtoupper($request->signo)
        ]);

        return redirect()->route('unidades-medidas.index')->with('warning', 'Unidad de medida editada');
    }

    public function destroy(Request $request)
   {
        $unidad = UnidadMedida::find($request->unidad_id);

        $unidad->delete();

        return redirect()->route('unidades-medidas.index')->with('danger','Unidad de medida eliminada');
    }
}
