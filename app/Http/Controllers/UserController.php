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

    public function store()
    {
        dd(request()->all());

        Toastr::success('La notificación ha sido mostrada con éxito', 'Título de la notificación');

        return redirect('users');
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
        //
    }

    
    public function destroy()
    {
        //
    }
}
