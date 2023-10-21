<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
   
    public function index()
    {
        $sucursales = Sucursal::get();

        return view('pages.sucursales.index', compact('sucursales'));
    }

    public function create(){
        return view('pages.sucursales.create');
    }
   
    public function store()
    {        

        Sucursal::create([
            'descripcion' => strtoupper(request()->descripcion)
        ]);

        return redirect()->route('sucursales.index')->with('success', 'Sucursal Creada');
    }

   
    public function show($sucursal_id)
    {
        $sucursal = Sucursal::find($sucursal_id);

        return view('pages.sucursales.show', compact('sucursal'));
    }

    public function edit($sucursal_id){
        $sucursal = Sucursal::find($sucursal_id);

        return view('pages.sucursales.edit', compact('sucursal'));
    }
   
    public function update(Request $request, Sucursal $sucursal)
    {
        $sucursal = Sucursal::find($request->sucursal_id);
        
        $sucursal->update([
            'descripcion'   => strtoupper($request->descripcion)
        ]);

        return redirect()->route('sucursales.index')->with('warning','Sucursal editada');
    }

    public function destroy(Sucursal $sucursal)
    {
        $sucursal = Sucursal::find(request()->sucursal_id);

        $sucursal->delete();

        return redirect()->route('sucursales.index')->with('danger', 'Sucursal Eliminada');

    }
}
