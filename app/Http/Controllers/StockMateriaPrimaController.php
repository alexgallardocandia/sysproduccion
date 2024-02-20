<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\MateriaPrima;
use App\Models\StockMateriaPrima;
use Illuminate\Http\Request;

class StockMateriaPrimaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $almacenes = Almacen::whereHas('stock_materia_prima')->get();
        $materias = MateriaPrima::whereHas('stock_materia_prima')->get();
        $stocks = new StockMateriaPrima;

        if( request()->almacen_id) {
            $stocks = $stocks->where('almacen_id', request()->almacen_id);
        }
        if( request()->materia_prima_id) {
            $stocks = $stocks->where('materia_prima_id', request()->materia_prima_id);
        }

        $stocks = $stocks->paginate(20);
        return view('pages.stock.index', compact('stocks', 'almacenes', 'materias'));
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
     * @param  \App\Models\StockMateriaPrima  $stockMateriaPrima
     * @return \Illuminate\Http\Response
     */
    public function show(StockMateriaPrima $stockMateriaPrima)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockMateriaPrima  $stockMateriaPrima
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockMateriaPrima $stockMateriaPrima)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockMateriaPrima  $stockMateriaPrima
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockMateriaPrima $stockMateriaPrima)
    {
        //
    }
}
