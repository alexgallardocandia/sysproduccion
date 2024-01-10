<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermisoRequest;
use App\Http\Requests\UpdatePermisoRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    public function index()
    {
        $permisos = Permission::get();

        return view('pages.permisos.index', compact('permisos'));
    }
    public function create()
    {
        return view('pages.permisos.create');
    }
    public function store(CreatePermisoRequest $request)
    {
        if ($request->ajax()) {
            Permission::create([
                'name'          => $request->name,
                'display_name'  => strtoupper($request->display_name),
                'description'   => strtoupper($request->description)
            ]);

            toastr()->success('Permiso Creado Exitosamente ');

            return response()->json([
                'success' => true
            ]);
        }
        abort(404);
    }
    public function edit()
    {        
        $permiso = Permission::find(request()->route('permiso_id'));

        return view('pages.permisos.edit', compact('permiso'));
    }
    public function update(UpdatePermisoRequest $request)
    {
        // dd($request);
        if ($request->ajax()) {
            $permiso = Permission::find($request->permiso_id);
            $permiso->update([
                'name'          => $request->name,
                'display_name'  => strtoupper($request->display_name),
                'description'   => strtoupper($request->description)
            ]);

            toastr()->success('Permiso Editado Exitosamente ');

            return response()->json([
                'success' => true
            ]);
        }
        abort(404);
    }
    public function destroy()
    {

    }
}
