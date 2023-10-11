<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class LogController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request) {
        if ($request->username == auth()->guard()->user()->email && bcrypt($request->password) == auth()->guard()->user()->password) {
            return redirect()->intended('home')
	            ->withSuccess('Logado Correctamente');
        }
        return redirect()->route('login')->with('success', 'User Deleted successfully.');
    }
    public function logout(){
        auth()->logout();
        return redirect('login');
    }
    
}
