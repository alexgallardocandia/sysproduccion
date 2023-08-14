<?php

namespace App\Http\Controllers;

// use {{ namespacedModel }};
use App\Models\lain;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function index(lain $lain)
    {
        return view('layouts.principal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function create(lain $lain)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, lain $lain)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lain  $lain
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lain  $lain
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lain  $lain
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lain  $lain
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
