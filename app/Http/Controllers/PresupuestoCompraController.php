<?php

namespace App\Http\Controllers;

use App\Models\MateriaPrima;
use App\Models\PedidoCompra;
use App\Models\PresupuestoCompra;
use App\Models\Proveedor;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class PresupuestoCompraController extends Controller
{
    
    public function index()
    {
        $presupuestos = PresupuestoCompra::orderBy('id','DESC')->get();

        return view('pages.compras.presupuestos-compras.index', compact('presupuestos'));
    }
    
    public function create()
    {
        $pedidos_compras    = PedidoCompra::where('estado',1)->get();
        $proveedores        = Proveedor::get();
        $materias           = MateriaPrima::get();
        $umedidas           = UnidadMedida::get();
        return view('pages.compras.presupuestos-compras.create', compact('pedidos_compras','proveedores','materias','umedidas'));
    }
    public function store(Request $request)
    {
        //
    }
    
    public function show(PresupuestoCompra $presupuestoCompra)
    {
        //
    }
    
    public function update(Request $request, PresupuestoCompra $presupuestoCompra)
    {
        //
    }
    
    public function destroy(PresupuestoCompra $presupuestoCompra)
    {
        //
    }
}
