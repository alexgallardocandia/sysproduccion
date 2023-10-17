<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
   
    public function index()
    {
        $departamentos  = Departamento::get();
        
        return view('pages.departamentos.index', compact('departamentos'));
    }

    public function create() {
        return view('pages.departamentos.create');
    }
    public function store(Request $request)
    {
        if(request()->ajax()) {

            Departamento::create([
                'nombre'    => strtoupper($request->descripcion)
            ]);

            toastr()->success('Departamento Creado Exitosamente ');

            return response()->json([
                'success' => true
            ]);
        }
        abort(404);
    }

    public function show($departamento_id)
    {
        $departamento   = Departamento::find($departamento_id);
        return view('pages.departamentos.show', compact('departamento'));
    }

    public function edit($departamento_id) {
        $departamento   = Departamento::find($departamento_id);
        return view('pages.departamentos.edit', compact('departamento'));
    }
    
    public function update(Request $request)
    {

        $departamento   = Departamento::find($request->departamento_id);

        $departamento->update([
            'nombre'    => strtoupper($request->nombre)
        ]);

        return redirect()->route('departamentos.index')->with('success','Departamento Editado Correctamente');

    }

    public function destroy()
    {
        $departamento = Departamento::find(request()->departamento_id);

        $departamento->delete();

        return redirect()->route('departamentos.index')->with('danger','Departamento Eliminado');
    }
}
