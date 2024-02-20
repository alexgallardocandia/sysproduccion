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
        if (request()->modal_compra) {
            if (request()->ajax()) {
                $timbradoval = Timbrado::where('numero', $request->numero)->where('fecha_emision',Carbon::createFromFormat('d/m/Y',$request->fecha_emision)->format('Y-m-d'))->where('fecha_vencimiento',Carbon::createFromFormat('d/m/Y',$request->fecha_vencimiento)->format('Y-m-d'))->first();
            
                if($timbradoval){
                    return redirect()->route('compras.create')->with('danger','El numero de timbrado ya esta registrado');        
                }else{
                    Timbrado::create([
                        'numero'            => $request->numero,
                        'fecha_emision'     => Carbon::createFromFormat('d/m/Y',$request->fecha_emision)->format('Y-m-d'),
                        'fecha_vencimiento' => Carbon::createFromFormat('d/m/Y',$request->fecha_vencimiento)->format('Y-m-d'),
                        'estado'            => 1
                    ]);
        
                    return redirect()->route('compras.create')->with('success','Timbrado registrado exitosamente');
                }
            }
            abort(404);

        } else {

            $timbradoval = Timbrado::where('numero', $request->numero)->where('fecha_emision',Carbon::createFromFormat('d/m/Y',$request->fecha_emision)->format('Y-m-d'))->where('fecha_vencimiento',Carbon::createFromFormat('d/m/Y',$request->fecha_vencimiento)->format('Y-m-d'))->first();
            
            if($timbradoval){
                return redirect()->route('timbrados.creates')->with('danger','El numero de timbrado ya esta registrado');        
            }else{
                Timbrado::create([
                    'numero'            => $request->numero,
                    'fecha_emision'     => Carbon::createFromFormat('d/m/Y',$request->fecha_emision)->format('Y-m-d'),
                    'fecha_vencimiento' => Carbon::createFromFormat('d/m/Y',$request->fecha_vencimiento)->format('Y-m-d'),
                    'estado'            => 1
                ]);
    
                return redirect()->route('timbrados.index')->with('success','Timbrado registrado exitosamente');
            }
        }

    }

    public function show($timbrado_id)
    {
        $timbrado = Timbrado::find($timbrado_id);

        return view('pages.timbrados.show', compact('timbrado'));
    }

    public function edit(Timbrado $timbrado) {

        return view('pages.timbrados.edit', compact('timbrado'));
    }

    public function update(Request $request)
    {

        $timbrado = Timbrado::find($request->timbrado_id);

        $timbrado->update([
            'numero'            => $request->numero,
            'fecha_emision'     => Carbon::createFromFormat('d/m/Y',$request->fecha_emision)->format('Y-m-d'),
            'fecha_vencimiento' => Carbon::createFromFormat('d/m/Y',$request->fecha_vencimiento)->format('Y-m-d'),
            'estado'            => 1
        ]);

        return redirect()->route('timbrados.index')->with('success','Timbrado editado correctamente');
    }

    public function destroy(Request $request)
    {
        $timbrado = Timbrado::find($request->timbrado_id);

        $timbrado->delete();

        return redirect()->route('timbrados.index')->with('success', 'Timbrado eliminado correctamente');
    }
}
