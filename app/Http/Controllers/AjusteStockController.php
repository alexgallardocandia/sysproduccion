<?php

namespace App\Http\Controllers;

use App\Models\AjusteStock;
use Illuminate\Http\Request;

class AjusteStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.compras.ajuste-stocks.index');
    }


    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AjusteStock  $ajusteStock
     * @return \Illuminate\Http\Response
     */
    public function show(AjusteStock $ajusteStock)
    {
        //
    }

    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AjusteStock  $ajusteStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AjusteStock $ajusteStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AjusteStock  $ajusteStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(AjusteStock $ajusteStock)
    {
        //
    }

    public function pdf()
    {

    }
}
