<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Empleado;
use App\Models\Permission;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        $usuarios = User::get();

        return view('pages.users.index', compact('usuarios'));
    }

    public function create()
    {
        $empleados = Empleado::get();
        $permisos = Permission::get()->groupBy('description');
        
        return view('pages.users.create', compact('empleados', 'permisos'));
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'name'          => $request->nombre,
            'email'         => $request->email,
            'status'        => 1,
            'password'      => bcrypt($request->password),
            'empleado_id'   => $request->empleado_id
        ]);

        $user->syncPermissions($request->permission_id, '');

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function show(User $users)
    {
        return view('pages.users.show', compact('users'));
    }

    
    public function edit(User $users)
    {
        $empleados   = Empleado::get();
        $permisos = Permission::get()->groupBy('description');

        return view('pages.users.edit', compact('users', 'empleados', 'permisos'));
    }

    
    public function update(Request $request)
    {                
        $user = User::where('id', $request->user_id)->first();
        
        $user->update([
            'name'          => $request->nombre,
            'email'         => $request->email,
            'empleado_id'   => $request->empleado_id
        ]);

        if($request->password && $request->password != '') {
            $user->update([
                'password'      => bcrypt($request->password)
            ]);
        }

        if ($request->permission_id) {
            $user->syncPermissions($request->permission_id, 'work');
        }

        return redirect()->route('users.index')->with('success', 'Usuario editado exitosamente.');
    }

    
    public function destroy()
    {                
        $user=User::find(request()->id_usuario);              
        
        $user->update([
            'status' => 0
        ]);
        return redirect()->route('users.index')->with('success', 'Usuario inactivado.');

    }
}
