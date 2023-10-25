<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonasRequest;
use App\Models\Cargo;
use App\Models\Ciudad;
use App\Models\EstadoCivil;
use App\Models\Persona;
use App\Models\Sucursal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = DB::select('select * from v_personas');

        return view('pages.personas.index', compact('personas'));
    }

    public function create()
    {
        $eciviles = DB::select('select * from estado_civiles');
        $cargos = DB::select('select * from cargos');
        $sucursales = DB::select('select * from sucursales');
        $ciudades = DB::select('select * from ciudades');

        return view('pages.personas.create', compact('eciviles', 'cargos', 'sucursales', 'ciudades'));
    }

    public function store(CreatePersonasRequest $request)
    {
        // dd(request()->all());

        if ($request->ajax()) {
            $nombres = strtoupper($request->nombres);
            $apellidos = strtoupper($request->apellidos);
            $direccion = strtoupper($request->direccion);
            $created_at = date('Y-m-d H:i:s');
            $updated_at = date('Y-m-d H:i:s');

            DB::statement("INSERT INTO personas (id, created_at, updated_at, ci, nombres, apellidos, direccion, telefono, email, fecha_nacimiento, civil_id, cargo_id, sucursal_id, ciudad_id, deleted_at)
            VALUES(0, '$created_at', '$updated_at', '$request->ci', '$nombres', '$apellidos', '$direccion', '$request->telefono', '$request->email', '$request->fecha_nacimiento', $request->estado_id, 
            $request->cargo_id, $request->sucursal_id, $request->ciudad_id, NULL)");

            toastr()->success('Persona Creada!!');

            return response()->json([
                'success' => true,
            ]);
        }
        abort(404);
    }

    public function show($persona_id)
    {
        $p = DB::select('SELECT * FROM personas WHERE id = ?', [$persona_id]);

        $persona = [];

        foreach ($p as $per) {
            $persona = [
                'id'    => $per->id,
                'nombres'    => $per->nombres,
                'id'    => $per->id,
                'id'    => $per->id,
                'id'    => $per->id,
                'id'    => $per->id,
                'id'    => $per->id,
                'id'    => $per->id,
            ];

        }

        return view('pages.personas.show', compact('persona'));
    }

    public function edit($persona_id)
    {
        $eciviles = EstadoCivil::get();
        $cargos = Cargo::get();
        $sucursales = Sucursal::get();
        $ciudades = Ciudad::get();

        $persona = Persona::find($persona_id);

        return view('pages.personas.edit', compact('persona', 'eciviles', 'cargos', 'sucursales', 'ciudades'));
    }

    public function update(Request $request)
    {
        $persona = Persona::find($request->persona_id);
        $civalidate = Persona::where('id', '!=', $request->persona_id)
            ->where('ci', $request->ci)
            ->first();

        if ($civalidate) {
            return redirect()
                ->route('personas.index')
                ->with('danger', 'Numero de ci de persona ya existe en la base de datos');
        } else {
            $persona->update([
                'nombres' => strtoupper($request->nombres),
                'apellidos' => strtoupper($request->apellidos),
                'ci' => $request->ci,
                'direccion' => strtoupper($request->direccion),
                'telefono' => $request->telefono,
                'email' => $request->email,
                'fecha_nacimiento' => Carbon::createFromFormat('Y-m-d', $request->fecha_nacimiento),
                'civil_id' => $request->estado_id,
                'cargo_id' => $request->cargo_id,
                'sucursal_id' => $request->sucursal_id,
                'ciudad_id' => $request->ciudad_id,
            ]);

            return redirect()
                ->route('personas.index')
                ->with('warning', 'Persona editada');
        }
    }

    public function destroy()
    {
        $persona = Persona::find(request()->persona_id);

        $persona->delete();

        return redirect()
            ->route('personas.index')
            ->with('warning', 'Persona Eliminada');
    }
}
