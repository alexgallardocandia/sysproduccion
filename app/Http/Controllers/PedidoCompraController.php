<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePedidoComprasRequest;
use App\Models\MateriaPrima;
use App\Models\PedidoCompra;
use App\Models\PedidoCompraDetalle;
use App\Models\Persona;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class PedidoCompraController extends Controller
{
    public function index()
    {
        $pedidosc = PedidoCompra::get();
        
        return view('pages.compras.pedidos-compras.index',compact('pedidosc'));
    }

    public function create(){
        $personas = Persona::get();
        $materias = MateriaPrima::get();
        $umedidas = UnidadMedida::get();
        return view('pages.compras.pedidos-compras.create', compact('personas','materias','umedidas'));
    }

    public function store(CreatePedidoComprasRequest $request)
    {
        if (request()->ajax()) {            
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
                    'umedid_id'         => $request->umedidas[$key],                    
                ]);
            }

            toastr()->success('Pedido creado');

            return response()->json([
                'success' => true
            ]);
        }
        abort(404);
    }

    public function show($pedido_id)
    {
        $pedido = PedidoCompra::find($pedido_id);

        return view('pages.compras.pedidos-compras.show', compact('pedido'));
    }

    public function edit(){

    }

    public function update(Request $request, PedidoCompra $pedidoCompra)
    {
        //
    }

    public function destroy(PedidoCompra $pedidoCompra)
    {
        //
    }
}
