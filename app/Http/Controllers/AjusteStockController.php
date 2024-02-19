<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\AjusteStock;
use App\Models\AjusteStockDetalle;
use App\Models\MateriaPrima;
use App\Models\StockMateriaPrima;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AjusteStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ajuste_stocks = AjusteStock::get();
        return view('pages.compras.ajuste-stocks.index', compact('ajuste_stocks'));
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
        // dd(request()->all());
        if ( request()->ajax() ) {
            DB::beginTransaction();

            try {

                $ajusteStock = AjusteStock::create([
                    'fecha'         => Carbon::createFromFormat('d/m/Y', request()->fecha)->format('Y-m-d'),
                    'almacen_id'    => request()->almacen_id,
                    'user_id'       => Auth()->user()->id,
                    'estado'        => 1,
                ]);

                foreach ( request()->materias as $key => $value ) { 
                    AjusteStockDetalle::create([
                        'ajuste_stock_id'   => $ajusteStock->id,
                        'materia_prima_id'  => $value,
                        'cant_stock'        => request()->en_stock[$key],
                        'cant_almacen'      => request()->stock_fisico[$key],
                        'motivo'            => request()->motivo[$key]
                    ]);
                }


                foreach (request()->materias as $key => $value) {

                    $stock = StockMateriaPrima::where('almacen_id', request()->almacen_id)->where('materia_prima_id',$value)->first();

                    // if ($stock->materia_prima_id == $value && $stock->almacen_id == request()->almacen_id) {
                        $stock->update([
                            'actual' => request()->stock_fisico[$key]
                        ]);
                    // }

                }
            Log::info('hola');


                DB::commit();

                toastr()->success('Se ajusto el stock correctamente');
    
                return response()->json([
                    'success' => true
                ]);

            } catch (\Exception $e) {
                Log::error($e);
                
                DB::rollBack();
                
                toastr()->error('Error al crear el ajuste: ' . $e->getMessage());

                return response()->json([
                    'success' => false,
                    'error'   => $e->getMessage()
                ]);
            }
        }
        abort(404);
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
