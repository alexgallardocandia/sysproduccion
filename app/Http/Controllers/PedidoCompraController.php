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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

            DB::beginTransaction();

            try {

                $pedidocompra = PedidoCompra::create([
                    'prioridad'     => $request->prioridad,
                    'fecha_pedido'  => date('Y-m-d'),
                    'user_id'       => $request->user_id,
                    'estado'        => 1,
                ]);

                foreach ($request->materias as $key => $value) {                
                    PedidoCompraDetalle::create([
                        'pedido_compra_id'  => $pedidocompra->id,
                        'materia_prima_id'  => $value,
                        'cantidad'          => $request->cantidades[$key],                  
                    ]);
                }
                DB::commit();

                toastr()->success('Pedido Creado Exitosamente ','Pedido #'.$pedidocompra->id);

                return response()->json([
                    'success' => true
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error('Error al crear el pedido: ' . $e->getMessage());

                return response()->json([
                    'success' => false,
                    'error'   => $e->getMessage()
                ]);
            }
        }
        abort(404);
    }

    public function show(PedidoCompra $pedido_id)
    {
        return view('pages.compras.pedidos-compras.show', compact('pedido_id'));
    }

    public function edit(PedidoCompra $pedido_id)
    {
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

    public function update ( Request $request ) 
    {
        if ($request->ajax()) {

            DB::beginTransaction();
            try {
                $pedidoCompra = PedidoCompra::where('id', $request->pedido_compra_id)->first();
                //ACTUALIZAMOS LA CABECERA DEL PEDIDO
                $pedidoCompra->update([
                    'prioridad'     => $request->prioridad,
                    'estado'        => 1,
                    'fecha_pedido'  => Carbon::createFromFormat('d/m/Y', $request->fecha)->format('Y-m-d'),
                    'user_id'       => $request->user_id
                ]);
                
                //MANEJO DEL DETALLE
                $detalles = PedidoCompraDetalle::where('pedido_compra_id', $request->pedido_compra_id);

                $detalles->delete();

                foreach ($request->materias as $key => $value) {
                    PedidoCompraDetalle::create([
                        'pedido_compra_id'  => $request->pedido_compra_id,
                        'materia_prima_id'  => $value,
                        'cantidad'          => $request->cantidades[$key]
                    ]);
                }

                DB::commit();

                toastr()->success('Pedido de Compra Editado Exitosamente ');

                return response()->json([
                    'success' => true
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error('Error al editar el pedido: ' . $e->getMessage());

                return response()->json([
                    'success' => false,
                    'error'   => $e->getMessage()
                ]);
            }
        }
        abort(404);
    }

    public function destroy()
    {
        $pedido_compra = PedidoCompra::find(request()->pedidoc_id);
        $pedido_compra->delete();

        return redirect()->route('pedidos-compras.index')->with('success','Pedido de Compra #'. request()->pedidoc_id .' Eliminado');

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
