<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePresupuestoComprasRequest;
use App\Models\MateriaPrima;
use App\Models\PedidoCompra;
use App\Models\PresupuestoCompra;
use App\Models\PresupuestoCompraDetalle;
use App\Models\Proveedor;
use App\Models\UnidadMedida;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PresupuestoCompraController extends Controller
{
    
    public function index()
    {
        $presupuestos = PresupuestoCompra::orderBy('id','DESC')->get();
        
        return view('pages.compras.presupuestos-compras.index', compact('presupuestos'));
    }
    
    public function create()
    {
        $pedidos_compras    = PedidoCompra::where('estado',true)->get();
        $proveedores        = Proveedor::get();
        $materias           = MateriaPrima::get();
        $umedidas           = UnidadMedida::get();
        return view('pages.compras.presupuestos-compras.create', compact('pedidos_compras','proveedores','materias','umedidas'));
    }
    public function store(CreatePresupuestoComprasRequest $request)
    {
        if( request()->ajax() ) {
            DB::beginTransaction();
            try {
                $presupuestocompra  = PresupuestoCompra::create([
                    'numero'            => $request->numero,
                    'estado'            => 1,
                    'fecha'             => Carbon::createFromFormat('d/m/Y', $request->fecha)->format('Y-m-d'),
                    'validez'           => Carbon::createFromFormat('d/m/Y', $request->validez)->format('Y-m-d'),
                    'proveedor_id'      => $request->proveedor_id,
                    'pedido_compra_id'  => $request->pedido_compra_id
                ]);
    
                foreach( $request->materias as $key => $value ) {
                    PresupuestoCompraDetalle::create([
                        'presupuesto_compra_id'    => $presupuestocompra->id,
                        'materia_prima_id'  => $value,
                        'cantidad'          => $request->cantidades[$key],
                        'precio_unitario'   => $request->precios[$key],
                        // 'descuento'         => $request->descuentos[$key],
                        // 'umedid_id'         => $request->umedidas[$key],
                        'estado'            => 1,
                    ]);
                }
                DB::commit();
    
                toastr()->success('Presupuesto Creado Exitosamente ','#'.$presupuestocompra->id);
    
                return response()->json([
                    'success' => true
                ]);

            } catch (\Exception $e) {

                DB::rollBack();
                toastr()->error('Error al crear el presupuesto: ' . $e->getMessage());

                return response()->json([
                    'success' => false,
                    'error'   => $e->getMessage()
                ]);
            }
        }
        abort(404);
    }
    
    public function show($presupuesto_id)
    {
        $presupuestocompra = PresupuestoCompra::find($presupuesto_id);
        $details           = PresupuestoCompraDetalle::where('presupuesto_compra_id', $presupuesto_id)->get();
        $grand_total         = 0;
        $total_cant        = 0;
        $total_desc        = 0;
        $total_precio      = 0;
        foreach ($details as $detail) {
            $total_cant     += $detail->cantidad; 
            $total_desc     += $detail->descuento; 
            $total_precio   += $detail->precio_unitario; 
            $grand_total    += ($detail->precio_unitario * $detail->cantidad ) - $detail->descuento;
        }
        return view('pages.compras.presupuestos-compras.show', compact('presupuestocompra', 'details','total_cant', 'total_desc', 'total_precio', 'grand_total'));
    }
    
    public function edit($presupuesto_id)
    {
        $presupuesto_compra = PresupuestoCompra::find($presupuesto_id);
        $detalles           = PresupuestoCompraDetalle::where('presupuesto_compra_id', $presupuesto_id)->where('estado', 1)->get();
        $pedidos_compras    = PedidoCompra::where('estado',true)->get();
        $proveedores        = Proveedor::get();
        $materias           = MateriaPrima::get();
        $umedidas           = UnidadMedida::get();

        $precargado       = [];

        foreach ($detalles as $key => $value) {
            $precargado[]   = [
                'materianame'   => $detalles[$key]->materia_prima->nombre.' | '.$detalles[$key]->materia_prima->unidad_medida->descripcion , 
                'materia_id'    => $detalles[$key]->materia_prima_id, 
                'umedida'       => $detalles[$key]->materia_prima->unidad_medida->descripcion, 
                'umedida_id'    => $detalles[$key]->umedid_id, 
                'cantidad'      => $detalles[$key]->cantidad, 
                'precio'        => $detalles[$key]->precio_unitario, 
                'descuento'     => $detalles[$key]->descuento
            ];
        }

        return view('pages.compras.presupuestos-compras.edit', compact('presupuesto_compra', 'precargado','pedidos_compras','proveedores','materias','umedidas'));
    }

    public function update(CreatePresupuestoComprasRequest $request)
    {
        if( request()->ajax() ) {
            
            $nuevo_detalle      = false;

            $presupuesto_compra = PresupuestoCompra::find($request->presupuesto_compra_id); 
            $detalles           = PresupuestoCompraDetalle::where('presupuesto_compra_id', $request->presupuesto_compra_id);

            $presupuesto_compra->update([
                'numero'            => $request->numero,
                'estado'            => 1,
                'fecha'             => Carbon::createFromFormat('Y-m-d', $request->fecha)->format('Y-m-d'),
                'validez'           => Carbon::createFromFormat('Y-m-d', $request->validez)->format('Y-m-d'),
                'proveedor_id'      => $request->proveedor_id,
                'pedido_compra_id'  => $request->pedido_compra_id ? $request->pedido_compra_id : null,
            ]);

            foreach($presupuesto_compra->details as $key => $value) {
                if ( count($request->materias) == count($presupuesto_compra->details)) {//MISMA CANTIDAD DE DETALLE
                    if ( $request->materias[$key] == $value->materia_prima_id ) {//MISMO ID DE MATERIA
                        
                        $detalle    = PresupuestoCompraDetalle::where('presupuesto_compra_id', $value->presupuesto_compra_id)->where('materia_prima_id', $value->materia_prima_id)->first();

                        $value->update([
                            'cantidad'                  => $request->cantidades[$key],
                            'precio_unitario'           => $request->precios[$key],
                            'descuento'                 => $request->descuentos[$key],
                            'umedid_id'                 => $request->umedidas[$key],
                            'estado'                    => 1,
                        ]);
                    } else {
                       $nuevo_detalle   = true;
                    }
                } else {
                    $nuevo_detalle  = true;                    
                }
            }
            if ( $nuevo_detalle ) {

                // $detalle->delete();
                foreach ($detalles as $detalle) {
                    $detalle->delete();
                }
                
                foreach ( $request->materias as $key => $value ) {
                    PresupuestoCompraDetalle::create([
                        'presupuesto_compra_id'     => $presupuesto_compra->id,
                        'materia_prima_id'          => $value,
                        'cantidad'                  => $request->cantidades[$key],
                        'precio_unitario'           => $request->precios[$key],
                        'descuento'                 => $request->descuentos[$key],
                        'umedid_id'                 => $request->umedidas[$key],
                        'estado'                    => 1,
                    ]);
                }                
            }

            toastr()->success('Presupuesto Editado Exitosamente ');

            return response()->json([
                'success' => true
            ]);

        }
        abort(404);
    }
    
    public function destroy()
    {
        if ( request()->presupuesto_id ) {
            $presupuesto = PresupuestoCompra::find(request()->presupuesto_id);
            
            $presupuesto->update([
                'estado' => 3,
            ]);
            $presupuesto->details()->update([
                'estado' => 3,
            ]);
            
            return redirect()->route('presupuestos-compras.index')->with('Success','Presupuesto rechazado');
        } else {
            return redirect()->route('presupuestos-compras.index')->with('Danger','Ocurrio un error!!');
        }
        
    }

    public function ajax_getdetailspedidos()
    {
        if(request()->ajax()){
            $pedidos_compras    = PedidoCompra::findOrFail(request()->pedido_compra_id);
            $detalles           = [];

            foreach ($pedidos_compras->details as $value) 
            {
                $detalles[] = [
                    'materianame'   => $value->materia_prima->nombre.' | '.$value->materia_prima->unidad_medida->descripcion,
                    'materia_id'    => $value->materia_prima_id,
                    'cantidad'      => $value->cantidad
                ];
            }
            return response()->json(['detalles' => $detalles]);
        }
        abort(404);        


    }
    public function before_aprove($presupuesto_id)
    {
        $presupuestocompra = PresupuestoCompra::find($presupuesto_id);
        $details           = PresupuestoCompraDetalle::where('presupuesto_compra_id', $presupuesto_id)->get();
        $grand_total       = 0;
        $total_cant        = 0;
        $total_desc        = 0;
        $total_precio      = 0;
        foreach ($details as $detail) {
            $total_cant     += $detail->cantidad; 
            $total_precio   += $detail->precio_unitario; 
            $grand_total    += ($detail->precio_unitario * $detail->cantidad ) - $detail->descuento;
        }
        return view('pages.compras.presupuestos-compras.before-aprove', compact('presupuestocompra', 'details','total_cant', 'total_desc', 'total_precio', 'grand_total'));
    }
    public function aprove()
    {
        if ( request()->ajax() ) {

            $presupuesto_compra = PresupuestoCompra::find(request()->presupuesto_id);

            if ( request()->check_aprove ) {

                foreach ( request()->detail_id_materia as $key => $value ) {

                    if ( isset(request()->check_aprove[$value]) ) {

                        $presupuesto_compra->details()->where('materia_prima_id', $value)->update(['estado' => 2]);

                    }
                }

                $presupuesto_compra->update(['estado' => 2]);
                $presupuesto_compra->pedido_compra->update(['estado' => 2]);

                toastr()->success('Presupuesto Aprobado');
    
                return response()->json(['success' => true]);

            } else {

                toastr()->warning('Sin cambios');
    
                return response()->json(['success' => true]);
            }
        }
        abort(404);
    }
}
