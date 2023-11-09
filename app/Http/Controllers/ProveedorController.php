<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{

    public function index()
    {
        $proveedores = Proveedor::get();

        return view('pages.proveedores.index', compact('proveedores'));
    }

    public function create(){
        $ciudades = Ciudad::get();

        return view('pages.proveedores.create',compact('ciudades'));
    }

    public function store(Request $request)
    {
        Proveedor::create([
            'razon_social'  => strtoupper($request->razon_social),
            'ruc'           => $request->ruc,
            'telefono'      => $request->telefono,
            'direccion'     => $request->direccion,
            'email'         => $request->email,
            'ciudad_id'     => $request->ciudad_id,
        ]);
        return redirect()->route('proveedores.index')->with('success','Proveedor Creado');
    }

    public function show($proveedor_id)
    {
        $proveedor = Proveedor::find($proveedor_id);

        return view('pages.proveedores.show', compact('proveedor'));
    }

    public function edit($proveedor_id){
        $proveedor = Proveedor::find($proveedor_id);
        $ciudades = Ciudad::get();
        return view('pages.proveedores.edit', compact('proveedor', 'ciudades'));
    }

    public function update(Request $request)
    {
        $proveedor = Proveedor::find($request->proveedor_id);

        $proveedor->update([
            'razon_social'  => strtoupper($request->razon_social),
            'ruc'           => $request->ruc,
            'telefono'      => $request->telefono,
            'direccion'     => $request->direccion,
            'email'         => $request->email,
            'ciudad_id'     => $request->ciudad_id
        ]);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor Editado exitosamente');
    }

    public function destroy(Request $request)
    {
        $proveedor = Proveedor::find($request->proveedor_id);

        $proveedor->delete();

        return redirect()->route('proveedores.index')->with('success','Proveedor Eliminado');
    }
}
