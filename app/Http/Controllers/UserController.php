<?php

namespace App\Http\Controllers;

// use {{ namespacedModel }};
use App\Models\lain;
use App\Models\User;
use Illuminate\Http\Request;
use Toastr;

class UserController extends Controller
{
    
    public function index(lain $lain)
    {
        $usuarios = User::get();
        return view('pages.users.index', compact('usuarios'));
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
    {
        User::create([
            'name'      => $request->nombre,
            'email'     => $request->email,
            'status'     => 1,
            'password'  => bcrypt($request->password)
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function show(User $users)
    {
        // dd($users);
        return view('pages.users.show', compact('users'));
    }

    
    public function edit(User $users)
    {
        return view('pages.users.edit', compact('users'));
    }

    
    public function update(Request $request)
    {                
        $user = User::where('id', $request->user_id)->first();
        
        $user->update([
            'name'      => $request->nombre,
            'email'     => $request->email,
            'password'  => bcrypt($request->password,)

        ]);
        return redirect()->route('users.index')->with('warning', 'Usuario editado exitosamente.');
    }

    
    public function destroy()
    {                
        $user=User::find(request()->id_usuario);              
        
        $user->update([
            'status' => 0.00
        ]);
        return redirect()->route('users.index')->with('danger', 'Usuario inactivado.');

    }
}
