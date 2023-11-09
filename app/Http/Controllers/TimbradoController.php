<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Timbrado;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimbradoController extends Controller
{
   
    public function index()
    {
        $timbrados=Timbrado::get();
        return view('pages.timbrados.index',compact('timbrados'));
    }

    public function create()
    {
        $proveedores = Proveedor::get();
        return view('pages.timbrados.create', compact('proveedores'));
    }
    
    public function store(Request $request)
    {        
        $timbradoval = Timbrado::where('numero', $request->numero)->where('fecha_emision',$request->fecha_emision)->where('fecha_vencimiento',$request->fecha_vencimiento)->first();
        
        if($timbradoval){
            return redirect()->route('timbrados.creates')->with('danger','El numero de timbrado ya esta registrado');        
        }else{
            Timbrado::create([
                'numero'            => $request->numero,
                'fecha_emision'     => Carbon::createFromFormat('Y-m-d',$request->fecha_emision),
                'fecha_vencimiento' => Carbon::createFromFormat('Y-m-d',$request->fecha_vencimiento),
                'tipo'              => $request->tipo,
                'estado'            => 1
            ]);

            return redirect()->route('timbrados.index')->with('success','Timbrado registrado exitosamente');
        }

    }

    public function show($timbrado_id)
    {
        $timbrado = Timbrado::find($timbrado_id);

        return view('pages.timbrados.show', compact('timbrado'));
    }

    public function edit($timbrado_id){
        $timbrado = Timbrado::find($timbrado_id);

        return view('pages.timbrados.edit', compact('timbrado'));
    }

    public function update(Request $request)
    {
        $timbrado = Timbrado::find($request->timbrado_id);

        $timbrado->update([
            'numero'            => $request->numero,
            'fecha_emision'     => Carbon::createFromFormat('Y-m-d',$request->fecha_emision),
            'fecha_vencimiento' => Carbon::createFromFormat('Y-m-d',$request->fecha_vencimiento),
            'tipo'              => $request->tipo,
            'estado'            => 1
        ]);

        return redirect()->route('timbrados.index')->with('warning','Timbrado editado correctamente');
    }

    public function destroy(Request $request)
    {
        $timbrado = Timbrado::find($request->timbrado_id);

        $timbrado->delete();

        return redirect()->route('timbrados.index')->with('danger', 'Timbrado eliminado correctamente');
    }
}
