<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LogController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (auth()->attempt(['name' => $request->username, 'password' => $request->password, 'status' => 1], $request->remember)) {
            $api_token = Str::random(40);
            auth()->user()->update(['api_token' => $api_token]);
            return redirect('/home')->with('success','Acceso al Sistema');
        }

        return redirect()->route('login')->with('error', 'Nombre de Usuario o Password no valido');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}