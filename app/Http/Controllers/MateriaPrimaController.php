<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMateriaPrimaRequest;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\MateriaPrima;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class MateriaPrimaController extends Controller
{    
    public function index() {

        $materias   = MateriaPrima::orderBy('id', 'DESC')->get();

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

    public function show(MateriaPrima $materia_id) {

        return view('pages.compras.materias-primas.show', compact('materia_id'));
    }

    public function edit(MateriaPrima $materia_id) {

        $unidades   = UnidadMedida::get();
        $categorias = Categoria::get();
        $marcas     = Marca::get();
        
        return view('pages.compras.materias-primas.edit', compact('unidades','materia_id', 'categorias', 'marcas'));
    }

    public function update(CreateMateriaPrimaRequest $request) {

        if ($request->ajax()) {

            $materia    = MateriaPrima::find($request->materia_id);
    
            $materia->update([
                'nombre'            => strtoupper($request->nombre),
                'unidad_medida_id'  => $request->umedida_id,
                'marca_id'          => $request->marca_id,
                'categoria_id'      => $request->categoria_id,
                'tipo'              => $request->umedida_id,
            ]);
    
            toastr()->success('Materia Prima Editada');
            
            return response()->json([ 'success' => true ]);
        }
        abort(404);
    }

    public function destroy(Request $request) {
        
        $materia = MateriaPrima::find($request->materia_id);

        $materia->delete();

        return redirect()->route('materias-primas.index')->with('danger','Materia prima eliminada');
    }
}
