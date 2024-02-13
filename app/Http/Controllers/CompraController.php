<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\CompraCuota;
use App\Models\Compra;
use App\Models\OrdenCompra;
use App\Models\CompraDetalle;
use App\Models\Timbrado;
use App\Models\MateriaPrima;
use App\Models\StockMateriaPrima;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = Compra::orderBy('id','DESC')->get();

        return view('pages.compras.compras.index', compact('compras'));
    }

    public function create()
    {
        $orden_compras  = OrdenCompra::where('estado', 2)->whereDoesntHave('compra')->get();
        $timbrados      = Timbrado::where('estado', 1)->get();

        return view('pages.compras.compras.create', compact('orden_compras', 'timbrados'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if (request()->ajax()) {

            DB::beginTransaction();

            try {
                $monto_cuota = 0;
                $frecuencia  = intval($request->frecuencia);

                $compra = Compra::create([
                    'proveedor_id'      => $request->proveedor_id,
                    'orden_compra_id'   => $request->orden_compra_id,
                    'timbrado_id'       => $request->timbrado_id,
                    'fecha'             => Carbon::createFromFormat('d/m/Y',$request->fecha)->format('Y-m-d'),
                    'nro_factura'       => $request->nro_factura,
                    'condicion'         => $request->condicion,
                    'electronico'       => 0,
                    'descuento'         => $request->descuento,
                ]);
                
                $almacen = Almacen::where('sucursal_id', $compra->orden_compra->solicitante->sucursal_id)->first();

                foreach( $request->materias as $key => $value ) {
                    
                    $materia_prima = MateriaPrima::find($value);

                    $exenta = $materia_prima->tipo_impuesto_id == 3 ? intval($request->precios[$key]) * intval($request->cantidades[$key]) : 0;
                    $iva5   = $materia_prima->tipo_impuesto_id == 2 ? ( intval($request->precios[$key]) * intval($request->cantidades[$key])) / 21  : 0;
                    $iva10  = $materia_prima->tipo_impuesto_id == 1 ? ( intval($request->precios[$key]) * intval($request->cantidades[$key])) / 11  : 0;
                    
                    CompraDetalle::create([
                        'compra_id'         => $compra->id,
                        'materia_prima_id'  => $value,
                        'cantidad'          => $request->cantidades[$key],
                        'precio_unitario'   => $request->precios[$key],
                        'exenta'            => $exenta,
                        'iva5'              => $iva5,
                        'iva10'             => $iva10
                    ]);
                    
                    $old_stock = StockMateriaPrima::where('almacen_id',$almacen->id)->where('materia_prima_id', $value)->first();

                    if($old_stock) { //si ya existe un stock con el mismo almacen y la misma materia prima
                        if(($old_stock->actual + $request->cantidades[$key]) > $old_stock->cantidad_maxima) { //si supera la cantidad maxima
                            

                        } else {
                            
                            $old_stock->update([
                                'actual' => $old_stock->actual + $request->cantidades[$key],
                            ]);
                        }
                    } else {
                        StockMateriaPrima::create([
                            'almacen_id'        => $almacen->id,
                            'materia_prima_id'  => $value,
                            'cantidad_minima'   => 2,
                            'cantidad_maxima'   => 100,
                            'actual'            => $request->cantidades[$key]
                        ]);
                    }
                    
                    $monto_cuota += intval($request->precios[$key]) * intval($request->cantidades[$key]);
                }
                
                
                $monto_cuota = intval($monto_cuota / $request->nro_cuotas);

                $fecha_vencimiento = Carbon::createFromFormat('d/m/Y',$request->fecha);
                
                for ($i=1; $i <= $request->nro_cuotas ; $i++) { 

                    $fecha_vencimiento = $fecha_vencimiento->addDay($frecuencia);

                    CompraCuota::create([
                        'compra_id'         => $compra->id,
                        'cuota_nro'         => $i,
                        'monto_cuota'       => $monto_cuota,
                        'saldo'             => $monto_cuota,
                        'fecha_vencimiento' => $fecha_vencimiento->format('Y-m-d'),
                        'estado'            => 1,
                    ]);
                }

                DB::commit();

                toastr()->success('Compra Creada Exitosamente ','#'.$compra->id);
    
                return response()->json([
                    'success' => true
                ]);

            } catch (\Exception $e) {
                
                DB::rollBack();
                
                toastr()->error('Error al crear la compra: ' . $e->getMessage());

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
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        return view('pages.compras.compras.show', compact('compra'));
    }

    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        //
    }

    public function pdf()
    {

    }

    public function ajax_getorden()
    {
        if ( request()->ajax() ) {

            $ordencompra = OrdenCompra::find(request()->orden_compra_id);
            $detalles    = [];
            foreach ( $ordencompra->details as $detalle ) {

                $detalles[] = [
                    'materianame'       => $detalle->materia_prima->nombre." | ".$detalle->materia_prima->unidad_medida->descripcion,
                    'materia_id'        => $detalle->materia_prima_id,
                    'cantidad'          => $detalle->cantidad,
                    'precio'            => $detalle->precio_unitario,
                    'proveedor'         => $ordencompra->presupuesto_compra->proveedor_id ? $ordencompra->presupuesto_compra->proveedor->razon_social : '',
                    'proveedor_id'      => $ordencompra->presupuesto_compra->proveedor_id ?? ''
                ];

            }

            return response()->json($detalles);
        }
        abort(404);
    }
}