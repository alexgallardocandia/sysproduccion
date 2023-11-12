<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMateriaPrimaRequest;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\MateriaPrima;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class MateriaPrimaController extends Controller
{    
    public function index() {

        $materias   = MateriaPrima::get();

        return view('pages.compras.materias-primas.index', compact('materias'));
    }

    public function create() {

        $unidades   = UnidadMedida::get();
        $categorias = Categoria::get();
        $marcas     = Marca::get();
        return view('pages.compras.materias-primas.create', compact('unidades', 'categorias', 'marcas'));
    }

    public function store(CreateMateriaPrimaRequest $request) {

        if($request->ajax())
        {
            MateriaPrima::create([
                "nombre"            => strtoupper($request->nombre),
                "unidad_medida_id"  => $request->umedida_id,
                "marca_id"          => $request->marca_id,
                "categoria_id"      => $request->categoria_id,
                "tipo"              => $request->tipo
            ]);
            
            toastr()->success('Materia Prima Creada!');
            

            return response()->json(['success' => true]);
        }
        abort(404);
    }

    public function show($materia_id) {

        $materia = MateriaPrima::find($materia_id);

        return view('pages.compras.materias-primas.show', compact('materia'));
    }

    public function edit($materia_id) {

        $materia    = MateriaPrima::find($materia_id);
        $unidades   = UnidadMedida::get();
        $categorias = Categoria::get();
        $marcas     = Marca::get();
        
        return view('pages.compras.materias-primas.edit', compact('unidades','materia', 'categorias', 'marcas'));
    }

    public function update(Request $request) {

        $materia    = MateriaPrima::find($request->materia_id);

        $materia->update([
            'descripcion'       => strtoupper($request->descripcion),
            'precio'            => $request->precio,
            'fecha_lote'        => $request->fecha_lote,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'umedida_id'        => $request->umedida_id,
        ]);

        return redirect()->route('materias-primas.index')->with('warning', 'Materia prima editada');
    }

    public function destroy(Request $request) {
        
        $materia = MateriaPrima::find($request->materia_id);

        $materia->delete();

        return redirect()->route('materias-primas.index')->with('danger','Materia prima eliminada');
    }
}
