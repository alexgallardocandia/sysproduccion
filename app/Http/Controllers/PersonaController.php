<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    
    public function index()
    {
        $personas = Persona::get();
        return view('pages.personas.index', compact('personas'));
    }

    public function create(){
        return view('pages.personas.create');
    }
    
    public function store(Request $request)
    {
        //
    }

    
    public function show(Persona $persona)
    {
        //
    }

    public function update(Request $request, Persona $persona)
    {
        //
    }

    public function destroy(Persona $persona)
    {
        //
    }
}
