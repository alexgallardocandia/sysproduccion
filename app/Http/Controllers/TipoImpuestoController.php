<?php

namespace App\Http\Controllers;

use App\Models\TipoImpuesto;
use Illuminate\Http\Request;

class TipoImpuestoController extends Controller
{
    
    public function index()
    {
        $tipos = TipoImpuesto::get();

        return view('pages.tipos-impuestos.index', compact('tipos'));
    }

    public function create(){
        return view('pages.tipos-impuestos.create');       
    }

    public function store(Request $request)
    {
        TipoImpuesto::create([
            'descripcion'   => strtoupper($request->descripcion),
            'valor'         => strtoupper($request->valor),
            'signo'         => strtoupper($request->signo)

        ]);

        return redirect()->route('tipos-impuestos.index')->with('success','Tipo de Impuesto Creado');
    }

    public function show($tipo_id)
    {
        $tipo = TipoImpuesto::find($tipo_id);

        return view('pages.tipos-impuestos.show', compact('tipo'));
    }

    public function edit($tipo_id){
        $tipo = TipoImpuesto::find($tipo_id);

        return view('pages.tipos-impuestos.edit', compact('tipo'));
    }

    public function update(Request $request)
    {
        $tipo = TipoImpuesto::find($request->tipo_id);
        $tipo->update([
            'descripcion'   => strtoupper($request->descripcion),
            'valor'         => strtoupper($request->valor),
            'signo'         => strtoupper($request->signo)

        ]);

        return redirect()->route('tipos-impuestos.index')->with('success','Tipo de Impuesto Editado');
    }

    public function destroy(Request $request)
    {
        $tipo = TipoImpuesto::find($request->tipo_id);

        $tipo->delete();

        return redirect()->route('tipos-impuestos.index')->with('success', 'Tipo de Impuesto Eliminado');
    }
}
