<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonasRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Models\Cargo;
use App\Models\Ciudad;
use App\Models\Empleado;
use App\Models\EstadoCivil;
use App\Models\Persona;
use App\Models\Sucursal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    public function index()
    {
        $personas = Empleado::get();

        return view('pages.empleados.index', compact('personas'));
    }

    public function create()
    {
        $eciviles = EstadoCivil::get();
        $cargos = Cargo::get();
        $sucursales = Sucursal::get();
        $ciudades = Ciudad::get();

        return view('pages.empleados.create', compact('eciviles', 'cargos', 'sucursales', 'ciudades'));
    }

    public function store(CreatePersonasRequest $request)
    {

        if ($request->ajax()) {

            Empleado::create([
                'ci'                => $request->ci,
                'nombres'           => $request->nombres,
                'apellidos'         => $request->apellidos,
                'direccion'         => $request->direccion,
                'telefono'          => $request->telefono,
                'email'             => $request->email,
                'fecha_nacimiento'  => $request->fecha_nacimiento,
                'civil_id'          => $request->civil_id,
                'cargo_id'          => $request->cargo_id,
                'sucursal_id'       => $request->sucursal_id
            ]);

            toastr()->success('Empleado Creada!!');

            return response()->json([
                'success' => true,
            ]);
        }
        abort(404);
    }

    public function show(Empleado $empleado)
    {
        return view('pages.empleados.show', compact('empleado'));
    }

    public function edit(Empleado $empleado)
    {
        $eciviles = EstadoCivil::get();
        $cargos = Cargo::get();
        $sucursales = Sucursal::get();
        $ciudades = Ciudad::get();

        return view('pages.empleados.edit', compact('empleado', 'eciviles', 'cargos', 'sucursales', 'ciudades'));
    }

    public function update(UpdateEmpleadoRequest $request)
    {
        if (request()->ajax()) {
            $empleado = Empleado::find($request->empleado_id);

            $empleado->update([
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

            toastr()->success('Empleado Editado!!');

            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function destroy()
    {
        $empleado = Empleado::find(request()->persona_id);

        $empleado->delete();

        return redirect()
            ->route('empleados.index')
            ->with('warning', 'Persona Eliminada');
    }
}
