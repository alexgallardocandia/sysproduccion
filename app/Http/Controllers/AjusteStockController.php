<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\AjusteStock;
use App\Models\MateriaPrima;
use App\Models\StockMateriaPrima;
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
        $almacenes = Almacen::whereHas('stock_materia_prima')->get();
        return view('pages.compras.ajuste-stocks.create', compact('almacenes'));
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

    public function ajax_getMateriaPrima()
    {
        $materia_primas = MateriaPrima::whereHas('stock_materia_prima', function($query) {
            $query->where('almacen_id', '=', request()->almacen_id);
        })->get();
        

        return response()->json($materia_primas);
    }
    public function ajax_getStockMateria()
    {

        $stock_materia = StockMateriaPrima::where('almacen_id', request()->almacen_id)->where('materia_prima_id', request()->materia_id)->first();

        return response()->json($stock_materia);
    }
}
