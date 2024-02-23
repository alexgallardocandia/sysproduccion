<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\CompraCuota;
use App\Models\Compra;
use App\Models\OrdenCompra;
use App\Models\CompraDetalle;
use App\Models\Empleado;
use App\Models\Timbrado;
use App\Models\MateriaPrima;
use App\Models\Proveedor;
use App\Models\StockMateriaPrima;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;


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
        $empleados  = Empleado::get();
        $proveedores = Proveedor::get();
        $materias = MateriaPrima::get();
        return view('pages.compras.compras.create', compact('orden_compras', 'empleados', 'proveedores', 'materias'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//         "orden_compra_id" => null
//   "solicitante_id" => "2"
//   "proveedor_input_id" => null
//   "proveedor_id" => "2"
//   "fecha" => "16/02/2024"
//   "timbrado" => "1236549"
//   "vencimiento_timbrado" => "04/02/2024"
//   "nro_factura" => "001-002-0003265"
//   "condicion" => "2"
//   "nro_cuotas" => "3"
//   "frecuencia" => "30"
//   "descuento" => "0"
        // dd($request->all());
        
        if (request()->ajax()) {

            // DB::beginTransaction();

            // try {
                $monto_cuota = 0;
                $frecuencia  = intval($request->frecuencia);

                //CREAMOS LA COMPRA
                $compra = Compra::create([
                    'proveedor_id'          => $request->proveedor_id,
                    'orden_compra_id'       => $request->orden_compra_id ?? NULL,
                    'solicitante_id'        => $request->solicitante_id ?? NULL ,
                    'proveedor_id'          => $request->proveedor_id,
                    'timbrado'              => $request->timbrado,
                    'vencimiento_timbrado'  => Carbon::createFromFormat('d/m/Y',$request->vencimiento_timbrado)->format('Y-m-d'),
                    'fecha'                 => Carbon::createFromFormat('d/m/Y',$request->fecha)->format('Y-m-d'),
                    'nro_factura'           => $request->nro_factura,
                    'condicion'             => $request->condicion,
                    'electronico'           => 0,
                    'descuento'             => $request->descuento,
                    'estado'                => 2,
                ]);

                $sucursal = $compra->solicitante_id ? $compra->solicitante->sucursal_id   : $compra->orden_compra->solicitante->sucursal_id;
                //RECUPERAMOS EL ALMACEN DEL SOLICITANTE
                $almacen = Almacen::where('sucursal_id', $sucursal)->first();

                //RECORREMOS EL DETALLE DE MATERIAS PRIMAS DE LA VISTA
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
                }
                //RECORREMOS LOS DETALLES DE LA COMPRA CREADA
                foreach($compra->details as $detalle) {

                    $old_stock = StockMateriaPrima::where('materia_prima_id', $detalle->materia_prima_id)->where('almacen_id',$almacen->id)->first();


                    if($old_stock) { //si ya existe un stock con el mismo almacen y la misma materia prima

                        if(($old_stock->actual + $request->cantidades[$key]) > $old_stock->cantidad_maxima) { //si supera la cantidad maxima
                            
                        } else {

                            if($old_stock->materia_prima_id == $detalle->materia_prima_id)
                            {
                                $old_stock->where('materia_prima_id', $detalle->materia_prima_id)->where('almacen_id',$almacen->id)->update([
                                    'actual' => $old_stock->actual + $request->cantidades[$key],
                                ]);
                            }
                        }
                    } else {
                        StockMateriaPrima::create([
                            'almacen_id'        => $almacen->id,
                            'materia_prima_id'  => $detalle->materia_prima_id,
                            'cantidad_minima'   => 2,
                            'cantidad_maxima'   => 100,
                            'actual'            => $detalle->cantidad
                        ]);
                    }
                    
                    $monto_cuota += intval($detalle->precio_unitario) * intval($detalle->cantidad);
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

                // DB::commit();

                toastr()->success('Compra Creada Exitosamente ','#'.$compra->id);
    
                return response()->json([
                    'success' => true
                ]);

            // } catch (\Exception $e) {
                
                // DB::rollBack();
                
                // toastr()->error('Error al crear la compra: ' . $e->getMessage());

                // return response()->json([
                //     'success' => false,
                //     'error'   => $e->getMessage()
                // ]);
            // }
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
    public function destroy(Request $request)
    {
        if( $request->compra_id ){
            
            $compra = Compra::find($request->compra_id);
    
            $almacen = Almacen::where('id', $compra->orden_compra->solicitante->sucursal_id)->first();

            $stock = StockMateriaPrima::where('almacen_id',$almacen->id);

            foreach ($compra->details as $detalle) {
                Log::info($detalle);
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
                        'estado' => 0
                    ]);
                }
            }
    
            $compra->update([
                'orden_compra_id'   => null,
                'estado'   => 3,
            ]);
    
            return redirect()->route('compras.index')->with('Success','Compra Anulada');

        } else {

            return redirect()->route('compras.index')->with('danger','Algo salio mal');

        }

        
    }

    public function pdf(Compra $compra)
    {
        
        $pdf   = FacadePdf::loadView('pages.compras.compras.compra-pdf', compact('compra'))->setPaper('A4', 'portrait');
        return $pdf->stream('orden_compra_'.$compra->id);
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

    public function libro_compras()
    {
        // dd(request()->all());
        $proveedores = Proveedor::get();
        $compras = Compra::orderBy('id','DESC');

        if (request()->compra_status) {
            $compras = $compras->where('estado',request()->compra_status);
        }
        if (request()->proveedor_id) {
            $compras = $compras->where('proveedor_id',request()->proveedor_id);
        }
        if (request()->rango) {
            
            if (count(explode('to',str_replace(' ', '', request()->rango))) == 1) {
                $from_date  = Carbon::createFromFormat('d/m/Y', explode('to',str_replace(' ', '', request()->rango))[0])->format('Y-m-d');
                $until_date = Carbon::createFromFormat('d/m/Y', explode('to',str_replace(' ', '', request()->rango))[0])->format('Y-m-d');
                $compras = $compras->whereBetween('fecha', [$from_date, $until_date]);
            } else {

                $from_date  = Carbon::createFromFormat('d/m/Y', explode('to',str_replace(' ', '', request()->rango))[0])->format('Y-m-d');
                $until_date = Carbon::createFromFormat('d/m/Y', explode('to',str_replace(' ', '', request()->rango))[1])->format('Y-m-d');
                $compras = $compras->whereBetween('fecha', [$from_date, $until_date]);
            }
        }
        $compras = $compras->paginate(20);

        return view('pages.compras.compras.libro-compras', compact('compras','proveedores'));
    }
}