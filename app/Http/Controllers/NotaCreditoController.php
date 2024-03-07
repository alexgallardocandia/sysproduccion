<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\NotaCreditoMotivo;
use App\Models\Timbrado;
use App\Models\NotaCredito;
use App\Models\Almacen;
use App\Models\CompraCuota;
use App\Models\StockMateriaPrima;
use App\Models\NotaCreditoDetalle;
use App\Models\MateriaPrima;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotaCreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nota_creditos = NotaCredito::orderBy('id','DESC')->get();

        return view('pages.compras.nota-creditos.index', compact('nota_creditos'));
    }

    public function create()
    {
        $timbrados = Timbrado::where('estado', 1)->where('fecha_vencimiento','>=',now())->get();
        $compras = Compra::where('estado', 2)->get();
        $nota_motivos = NotaCreditoMotivo::get();
        $proveedores = Proveedor::get();

        return view('pages.compras.nota-creditos.create', compact('timbrados','compras','nota_motivos','proveedores'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(request()->ajax()) {

            if( $request->compra_id ){

                DB::beginTransaction();
                try {

                    $compra = Compra::find($request->compra_id);
        
                    $sucursal = $compra->solicitante_id ? $compra->solicitante->sucursal_id   : $compra->orden_compra->solicitante->sucursal_id;

                    $almacen = Almacen::where('id', $sucursal)->first();
        
                    $stock = StockMateriaPrima::where('almacen_id',$almacen->id);
        
                    foreach ($compra->details as $detalle) {

                        $stock = $stock->where('materia_prima_id',$detalle->materia_prima_id)->first();
            
                        if ($stock) {
                            if ($stock->materia_prima_id == $detalle->materia_prima_id) {
            
                                $stock->where('materia_prima_id', $detalle->materia_prima_id)->where('almacen_id',$almacen->id)->update([
                                    'actual'    => $stock->actual - $detalle->cantidad,
                                ]);
                            }
                        }
                    }
            
                    $compra_cuotas = CompraCuota::where('compra_id', $compra->id)->get();
                    
                    if ($compra_cuotas) {
            
                        foreach ($compra_cuotas as $key => $cuota) {
                            
                            $cuota->update([
                                'estado' => 3
                            ]);
                        }
                    }
            
                    $compra->update([
                        'orden_compra_id'   => null,
                        'estado'   => 3,
                    ]);

                    $nota_credito = NotaCredito::create([
                        'numero'        => request()->numero,
                        'compra_id'     => request()->compra_id,
                        'proveedor_id'  => request()->proveedor_id,
                        'motivo_id'     => request()->motivo_id,
                        'timbrado_id'   => request()->timbrado_id,
                        'fecha'         => Carbon::createFromFormat('d/m/Y',request()->fecha)->format('Y-m-d'),
                    ]);

                    foreach( request()->materias as $key => $value ) {
                    
                        $materia_prima = MateriaPrima::find($value);
                        Log::info($materia_prima);
                        $exenta = $materia_prima->tipo_impuesto_id == 3 ? intval(request()->precios[$key]) * intval(request()->cantidades[$key]) : 0;
                        $iva5   = $materia_prima->tipo_impuesto_id == 2 ? ( intval(request()->precios[$key]) * intval(request()->cantidades[$key])) / 21  : 0;
                        $iva10  = $materia_prima->tipo_impuesto_id == 1 ? ( intval(request()->precios[$key]) * intval(request()->cantidades[$key])) / 11  : 0;
                        Log::info("exenta: $exenta iva5: $iva5 iva10: $iva10");
                        NotaCreditoDetalle::create([
                            'nota_credito_id'   => $nota_credito->id,
                            'materia_prima_id'  => $value,
                            'cantidad'          => request()->cantidades[$key],
                            'precio_unitario'   => request()->precios[$key],
                            'exenta'            => intval($exenta),
                            'iva_5'              => intval($iva5),
                            'iva_10'             => intval($iva10)
                        ]);
                    }

                    DB::commit();
                    return redirect()->route('nota-creditos.index')->with('Success','Nota Credito Creada');

                } catch (\Exception $e) {
                    Log::info($e);
                    DB::rollBack();
                
                    toastr()->error('Error al crear la nota de credito: ' . $e->getMessage());

                    return response()->json([
                        'success' => false,
                        'error'   => $e->getMessage()
                    ]);
                }
    
            } else {
    
                return redirect()->route('nota-creditos.index')->with('danger','Algo salio mal');
    
            }
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NotaCredito  $notaCredito
     * @return \Illuminate\Http\Response
     */
    public function show(NotaCredito $nota)
    {
        return view('pages.compras.nota-creditos.show', compact('nota'));
    }

    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotaCredito  $notaCredito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotaCredito $notaCredito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotaCredito  $notaCredito
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotaCredito $notaCredito)
    {
        //
    }

    public function ajax_getCompras()
    {
        if ( request()->ajax() ) {

            $compra = Compra::find(request()->compra_id);
            $detalles    = [];
            foreach ( $compra->details as $detalle ) {

                $detalles[] = [
                    'materianame'       => $detalle->materia_prima->nombre." | ".$detalle->materia_prima->unidad_medida->descripcion,
                    'materia_id'        => $detalle->materia_prima_id,
                    'cantidad'          => $detalle->cantidad,
                    'precio'            => $detalle->precio_unitario,
                    'proveedor'         => $compra->proveedor_id ? $compra->proveedor->razon_social : '',
                    'proveedor_id'      => $compra->proveedor_id ?? ''
                ];

            }

            return response()->json($detalles);
        }
        abort(404);
    }
}
