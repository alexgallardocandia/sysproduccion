<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCargosRequest;
use App\Models\Cargo;
use App\Models\Departamento;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    
    public function index()
    {
        $cargos = Cargo::get();

        return view('pages.cargos.index', compact('cargos'));
    }
    
    public function create(){
        $departamentos  = Departamento::get();

        return view('pages.cargos.create', compact('departamentos'));
    }

    public function store(CreateCargosRequest $request)
    {
        Cargo::create([
            'descripcion'       => strtoupper($request->descripcion),
            'departamento_id'   => $request->departamento_id
        ]);

        return redirect()->route('cargos.index')->with('success', 'Cargo creado');
    }

    public function show($cargo_id)
    {
        $cargos = Cargo::find($cargo_id);        
        return view('pages.cargos.show', compact('cargos'));
    }

    public function edit($cargo_id){
        $departamentos  = Departamento::get();
        $cargos         = Cargo::find($cargo_id);

        return view('pages.cargos.edit', compact('cargos','departamentos'));
    }

    public function update(Request $request)
    {
        $cargo = Cargo::find($request->cargo_id);

        $cargo->update([
            'descripcion'       => strtoupper($request->descripcion),
            'departamento_id'   => $request->departamento_id
        ]);

        return redirect()->route('cargos.index')->with('warning','Cargo editado');
    }

    public function destroy()
    {
        $cargo = Cargo::find(request()->cargo_id);

        $cargo->delete();

        return redirect()->route('cargos.index')->with('danger','Cargo Eliminado');    
    }
}
