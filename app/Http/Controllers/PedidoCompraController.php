<?php

namespace App\Http\Controllers;

use App\Models\MateriaPrima;
use App\Models\PedidoCompra;
use App\Models\Persona;
use App\Models\UnidadMedida;
use App\Models\User;
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

    public function store(Request $request)
    {
        //
    }

    public function show(PedidoCompra $pedidoCompra)
    {
        //
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
