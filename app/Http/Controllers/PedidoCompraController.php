<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePedidoComprasRequest;
use App\Models\Empleado;
use App\Models\MateriaPrima;
use App\Models\PedidoCompra;
use App\Models\PedidoCompraDetalle;
use App\Models\UnidadMedida;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PedidoCompraController extends Controller
{
    public function index()
    {
        $pedidosc = PedidoCompra::orderby('id', 'DESC')->get();
        
        return view('pages.compras.pedidos-compras.index',compact('pedidosc'));
    }

    public function create(){
        $personas = Empleado::get();
        $materias = MateriaPrima::get();
        $umedidas = UnidadMedida::get();
        return view('pages.compras.pedidos-compras.create', compact('personas','materias','umedidas'));
    }

    public function store(CreatePedidoComprasRequest $request)
    {
        if (request()->ajax()) {
            dd(request()->all());
            $pedidocompra = PedidoCompra::create([
                'prioridad'     => $request->prioridad,
                'fecha_pedido'  => date('Y-m-d'),
                'user_id'       => $request->user_id,
                'estado'        => 1,
            ]);

            foreach ($request->materias as $key => $value) {                
                PedidoCompraDetalle::create([
                    'pedido_compra_id'  => $pedidocompra->id,
                    'materia_prima_id'  => $request->materias[$key],
                    'cantidad'          => $request->cantidades[$key],                  
                ]);
            }

            toastr()->success('Pedido Creado Exitosamente ','Pedido #'.$pedidocompra->id);

            return response()->json([
                'success' => true
            ]);
        }
        abort(404);
    }

    public function show($pedido_id)
    {
        $pedido     = PedidoCompra::find($pedido_id);
        $details    = PedidoCompraDetalle::where('pedido_compra_id', $pedido_id)->get();

        return view('pages.compras.pedidos-compras.show', compact('pedido', 'details'));
    }

    public function edit(PedidoCompra $pedido_id){
        $detalles   = [];
        $personas   = Empleado::get();
        $materias   = MateriaPrima::get();
        $umedidas   = UnidadMedida::get();

        foreach ($pedido_id->details as $key => $det) {
            $detalles []  = [
                'materianame'   => $det->materia_prima->nombre,
                'cantidad'      => $det->cantidad,
                'materia_id'    => $det->materia_prima_id
            ];
        }

        return view('pages.compras.pedidos-compras.edit', compact('personas','materias','umedidas', 'pedido_id', 'detalles'));
    }

    public function update ( Request $request ) {
        if ($request->ajax()) {
            $pedidoCompra = PedidoCompra::where('id', $request->pedido_compra_id)->first();
            //ACTUALIZAMOS LA CABECERA DEL PEDIDO
            $pedidoCompra->update([
                'prioridad'     => $request->prioridad,
                'estado'        => 1,
                'fecha_pedido'  => Carbon::createFromFormat('d/m/Y', $request->fecha)->format('Y-m-d'),
                'user_id'       => $request->user_id
            ]);

            //MANEJO DEL DETALLE
            if ( count($pedidoCompra->details) == count($request->materias) ) {
                foreach( $pedidoCompra->details as $key => $value ) {
                    // dd($value);
                    if ( $request->materias[$key] == $value->materia_prima_id ) {//MISMO ID DE MATERIA
                        $value->update([
                            'cantidad'  => $request->cantidades[$key],
                        ]);
                    } else {
                        $value->update([
                            'pedido_compra_id'  => $pedidoCompra->id,
                            'materia_prima_id'  => $request->materias[$key],
                            'cantidad'          => $request->cantidades[$key],
                        ]);
                    }
                }
            } else {
                foreach ($pedidoCompra->details as $detalle) {
                    $detalle->delete();
                }

                foreach ($request->materias as $key => $value) {
                    PedidoCompraDetalle::create([
                        'pedido_compra_id'  => $pedidoCompra->id,
                        'materia_prima_id'  => $value,
                        'cantidad'          => $request->cantidades[$key]
                    ]);
                }
            }

            toastr()->success('Pedido de Compra Editado Exitosamente ');

            return response()->json([
                'success' => true
            ]);
        }
        abort(404);
    }

    public function destroy(PedidoCompra $pedidoCompra)
    {
        //
    }

    public function ajax_attributes() {
        if ( request()->ajax() ) {
            
            $materia_prima = MateriaPrima::find(request()->materia_id);

            $materia = [
                'presentacion'      => config('constants.materias-primas-presentacion.'.$materia_prima->presentacion),
                'unidad'            => $materia_prima->umedida->descripcion,
                'categoria'         => $materia_prima->categoria->nombre,
            ];            

            return response()->json([ 
                'materia'   => $materia,
            ]);

        }
        abort(404);
    }
}
