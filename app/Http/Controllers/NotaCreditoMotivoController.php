<?php

namespace App\Http\Controllers;

use App\Models\NotaCreditoMotivo;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class NotaCreditoMotivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nota_motivos = NotaCreditoMotivo::get();
        return view('pages.nota-motivos.index', compact('nota_motivos'));
    }


    public function create()
    {
        return view('pages.nota-motivos.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (request()->ajax()) {
            
            NotaCreditoMotivo::create([
                'nombre' => strtoupper($request->nombre)
            ]);

            toastr()->success('success', 'Motivo Agregado Exitosamente');

            return response()->json(['success'=> true]);
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NotaCreditoMotivo  $notaCreditoMotivo
     * @return \Illuminate\Http\Response
     */
    public function show(NotaCreditoMotivo $motivo)
    {
        return view('pages.nota-motivos.show', compact('motivo'));
    }

    public function edit(NotaCreditoMotivo $motivo)
    {
        return view('pages.nota-motivos.edit', compact('motivo'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotaCreditoMotivo  $notaCreditoMotivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $motivo = NotaCreditoMotivo::find($request->nota_motivo_id);

        $motivo->update([
            'nombre' => strtoupper($request->nombre),
        ]);

        return redirect()->route('nota-motivos.index')->with('success','Motivo Editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotaCreditoMotivo  $notaCreditoMotivo
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $motivo = NotaCreditoMotivo::find(request()->motivo_id);
        $motivo->delete();

        return redirect()->route('nota-motivos.index')->with('success', 'Motivo Eliminado');
    }
}
