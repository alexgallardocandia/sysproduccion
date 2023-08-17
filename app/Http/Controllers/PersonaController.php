<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Ciudad;
use App\Models\EstadoCivil;
use App\Models\Persona;
use App\Models\Sucursal;
use Carbon\Carbon;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    
    public function index()
    {
        $personas = Persona::get();

        return view('pages.personas.index', compact('personas'));
    }

    public function create(){
        $eciviles   = EstadoCivil::get();
        $cargos     = Cargo::get();
        $sucursales = Sucursal::get();
        $ciudades   = Ciudad::get();        
        return view('pages.personas.create', compact('eciviles','cargos','sucursales','ciudades'));
    }
    
    public function store(Request $request)
    {
        $civalidate = Persona::where('ci', $request->ci)->first();
        if ($civalidate) {
            return redirect()->route('personas.index')->with('danger', 'Numero de CI de persona ya existe en la base de datos');            
        } else {
            Persona::create([
                'nombres'           => strtoupper($request->nombres),
                'apellidos'         => strtoupper($request->apellidos),
                'ci'                => $request->ci,
                'direccion'         => strtoupper($request->direccion),
                'telefono'          => $request->telefono,            
                'email'             => $request->email,
                'fecha_nacimiento'  => Carbon::createFromFormat('Y-m-d',$request->fecha_nacimiento),
                'civil_id'          => $request->estado_id,
                'cargo_id'          => $request->cargo_id,
                'sucursal_id'       => $request->sucursal_id,
                'ciudad_id'         => $request->ciudad_id
            ]);
            
            return redirect()->route('personas.index')->with('success', 'Persona Creada');
        }        

    }

    
    public function show($persona_id)
    {        
        $persona = Persona::find($persona_id);
        return view('pages.personas.show', compact('persona'));
    }

    public function edit($persona_id){
        $eciviles   = EstadoCivil::get();
        $cargos     = Cargo::get();
        $sucursales = Sucursal::get();
        $ciudades   = Ciudad::get(); 
        
        $persona = Persona::find($persona_id);

        return view('pages.personas.edit', compact('persona','eciviles','cargos','sucursales','ciudades'));
    }

    public function update(Request $request)
    {

        $persona = Persona::find($request->persona_id);                   
        $civalidate = Persona::where('id','!=',$request->persona_id)->where('ci', $request->ci)->first();
        
        if($civalidate){
            return redirect()->route('personas.index')->with('danger','Numero de ci de persona ya existe en la base de datos');
        }else{
            $persona->update([
            'nombres'           => strtoupper($request->nombres),
            'apellidos'         => strtoupper($request->apellidos),
            'ci'                => $request->ci,
            'direccion'         => strtoupper($request->direccion),
            'telefono'          => $request->telefono,            
            'email'             => $request->email,
            'fecha_nacimiento'  => Carbon::createFromFormat('Y-m-d',$request->fecha_nacimiento),
            'civil_id'          => $request->estado_id,
            'cargo_id'          => $request->cargo_id,
            'sucursal_id'       => $request->sucursal_id,
            'ciudad_id'         => $request->ciudad_id
        ]);

        return redirect()->route('personas.index')->with('warning','Persona editada');
        }                
    }

    public function destroy()
    {
        $persona = Persona::find(request()->persona_id);

        $persona->delete();

        return redirect()->route('personas.index')->with('warning','Persona Eliminada'); 
    }
}
