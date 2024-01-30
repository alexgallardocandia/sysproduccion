<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = DB::select('SELECT * FROM categorias');

        return view('pages.compras.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('pages.compras.categorias.create');
    }

    public function store(Request $request)
    {
        $nombre = strtoupper($request->nombre);
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        DB::statement("INSERT INTO categorias (nombre, created_at, updated_at) VALUES ('$nombre','$created_at','$updated_at')");

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria Creada');
    }

    public function show($categoria_id)
    {
        $c = DB::select('SELECT * FROM categorias WHERE id = ?', [$categoria_id]);

        $categoria = [];

        foreach ($c as $cat) {
            $categoria = [
                'id' => $cat->id,
                'nombre' => $cat->nombre,
                'created_at' => $cat->created_at,
                'updated_at' => $cat->updated_at,
            ];
        }
        $categoria = (object) $categoria;

        return view('pages.compras.categorias.show', compact('categoria'));
    }

    public function edit($categoria_id)
    {
        $c = DB::select('SELECT * FROM categorias WHERE id = ?', [$categoria_id]);

        $categoria = [];

        foreach ($c as $cat) {
            $categoria = [
                'id' => $cat->id,
                'nombre' => $cat->nombre,
                'created_at' => $cat->created_at,
                'updated_at' => $cat->updated_at,
            ];
        }

        $categoria = (object) $categoria;

        return view('pages.compras.categorias.edit', compact('categoria'));
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $nombre = strtoupper($request->nombre);
            $updated_at = date('Y-m-d H:i:s');


            DB::statement('UPDATE categorias SET nombre = ?, updated_at = ? WHERE id = ?', [$nombre, $updated_at, $request->categoria_id]);

            toastr()->success('Categoria Editada Exitosamente ');

            return response()->json([
                'success' => true,
            ]);
        }
        abort(404);
    }

    public function destroy()
    {
        try {
            
            DB::delete('DELETE FROM categorias WHERE id = ?', [request()->categoria_id]);

            return redirect()
                ->route('categorias.index')
                ->with('success', 'Categoria Eliminada');
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }
}
