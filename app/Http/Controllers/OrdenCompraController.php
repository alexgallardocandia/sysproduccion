<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\OrdenCompra;
use App\Models\OrdenCompraDetalle;
use App\Models\PresupuestoCompra;
use App\Models\PresupuestoCompraDetalle;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdenCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $orden_compra =  OrdenCompra::orderBy('id','DESC')->get();
        return view('pages.compras.orden-compras.index', compact('orden_compra'));
    }

    public function create()
    {
        $presupuestos = PresupuestoCompra::where('estado', 2)->whereDoesntHave('orden_compra')->get();
        $empleados    = Empleado::where('estado', 1)->get();
        return view('pages.compras.orden-compras.create', compact('presupuestos','empleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( request()->ajax() ) {
            DB::beginTransaction();
            try {
                $orden_compra  = OrdenCompra::create([
                    'fecha'                     => Carbon::createFromFormat('d/m/Y', $request->fecha)->format('Y-m-d'),
                    'presupuesto_compra_id'     => $request->presupuesto_compra_id,
                    'solicitante_id'            => $request->solicitante_id,
                    'observacion'               => $request->observacion,
                    'descuento'                 => $request->descuento,
                    'estado'                    => 1
                ]);
    
                foreach( $request->materias as $key => $value ) {
                    OrdenCompraDetalle::create([
                        'orden_compra_id'    => $orden_compra->id,
                        'materia_prima_id'  => $value,
                        'cantidad'          => $request->cantidades[$key],
                        'precio_unitario'   => $request->precios[$key]
                    ]);
                }
                DB::commit();
    
                toastr()->success('Orden Creada Exitosamente ','#'.$orden_compra->id);
    
                return response()->json([
                    'success' => true
                ]);

            } catch (\Exception $e) {

                DB::rollBack();
                toastr()->error('Error al crear la orden: ' . $e->getMessage());

                return response()->json([
                    'success' => false,
                    'error'   => $e->getMessage()
                ]);
            }
        }
        abort(404);
    }

    public function aprove()
    {
        if(request()->orden_id) {
            $orden_compra = OrdenCompra::find(request()->orden_id);
            
            $orden_compra->update([
                'estado' => 2,
                'autorizador_id' => Auth()->user()->id,
            ]);
            
            return redirect()->route('orden-compras.index')->with('Success','Orden Nro. '.$orden_compra->id.' Aprobada');
        } else {
            return redirect()->route('orden-compras.index')->with('Danger','Algo salio mal!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function show(OrdenCompra $ordencompra)
    {
        return view('pages.compras.orden-compras.show', compact('ordencompra'));
    }

    public function edit()
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdenCompra $ordenCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $orden_compra = OrdenCompra::find(request()->orden_id);
            
        $orden_compra->update([
            'estado' => 3,
        ]);
        
        return redirect()->route('orden-compras.index')->with('Success','Orden Nro. '.$orden_compra->id.' rechazada');
    }

    public function ajax_getpresupuestos()
    {
        if ( request()->ajax() ) {

            $presupuesto = PresupuestoCompra::find(request()->presupuesto_compra_id);
            $detalles    = [];
            $presupuesto_detalles = PresupuestoCompraDetalle::where('presupuesto_compra_id', request()->presupuesto_compra_id)->where('estado', 2)->get();
            foreach ( $presupuesto_detalles as $detalle ) {

                $detalles[] = [
                    'materianame'       => $detalle->materia_prima->nombre." | ".$detalle->materia_prima->unidad_medida->descripcion,
                    'materia_id'        => $detalle->materia_prima_id,
                    'cantidad'          => $detalle->cantidad,
                    'precio'            => $detalle->precio_unitario,
                    'solicitante'       => $presupuesto->solicitante_id ? $presupuesto->solicitante->fullname : ($presupuesto->pedido_compra_id ? $presupuesto->pedido_compra->empleado->fullname : ''),
                    'solicitante_id'    => $presupuesto->solicitante_id ?? ($presupuesto->pedido_compra_id ? $presupuesto->pedido_compra->empleado_id : '')
                ];

            }

            return response()->json($detalles);
        }
        abort(404);
    }

    public function pdf(OrdenCompra $ordencompra)
    {
        // dd($ordencompra);
        $pdf   = FacadePdf::loadView('pages.compras.orden-compras.orden-pdf', compact('ordencompra'))->setPaper('A4', 'portrait');
        return $pdf->stream('orden_compra_'.$ordencompra->id);
    }
}
