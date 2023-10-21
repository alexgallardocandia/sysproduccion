<?php

namespace App\Http\Controllers;

use App\Models\EstadoCivil;
use Illuminate\Http\Request;

class EstadoCivilController extends Controller
{
    
    public function index()
    {
        $estados = EstadoCivil::get();
        return view('pages.estados_civiles.index', compact('estados'));
    }

    public function create(){
        return view('pages.estados_civiles.create');
    }

    public function store(Request $request)
    {
        EstadoCivil::create([
            'descripcion'  => strtoupper($request->descripcion)
        ]);

        return redirect()->route('estados-civiles.index')->with('success', 'Estado civil creado exitosamente.');
    }

    public function show($estado_id)
    {
        $estadocivil = EstadoCivil::find($estado_id);
        return view('pages.estados_civiles.show', compact('estadocivil'));
    }

    public function edit($estado_id){
        $estadocivil = EstadoCivil::find($estado_id);
        return view('pages.estados_civiles.edit', compact('estadocivil'));
    }

    public function update(Request $request)
    {
        $estadocivil = EstadoCivil::find($request->estado_id);
        
        $estadocivil->update([
            'descripcion'      => strtoupper($request->descripcion)
        ]);

        return redirect()->route('estados-civiles.index')->with('warning', 'Estado civil editado exitosamente.');        
    }

    public function destroy(Request $request)
    {
        $estadocivil = EstadoCivil::find($request->estado_id);

        $estadocivil->delete();

        return redirect()->route('estados-civiles.index')->with('danger', 'Estado civil eliminado');
    }
}
