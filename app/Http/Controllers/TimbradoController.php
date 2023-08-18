<?php

namespace App\Http\Controllers;

use App\Models\Timbrado;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Time;

class TimbradoController extends Controller
{
   
    public function index()
    {
        $timbrados=Timbrado::get();
        return view('pages.timbrados.index',compact('timbrados'));
    }

    public function create(){
        return view('pages.timbrados.create');
    }
    
    public function store(Request $request)
    {        
        $timbradoval = Timbrado::where('numero', $request->numero)->where('fecha_emision');
    }

    public function show(Timbrado $timbrado)
    {
        //
    }

    public function edit(){
        //
    }

    public function update(Request $request, Timbrado $timbrado)
    {
        //
    }

    public function destroy(Timbrado $timbrado)
    {
        //
    }
}
