<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\MateriaPrima;
use App\Models\UnidadMedida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class MateriasInitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marca =Marca::create([
            'nombre' => 'Sin Marca'
        ]);
        $unidad_medida = UnidadMedida::create([
            'descripcion'   => 'Unitario',
            'signo'         => 'UN'
        ]);
        $categoria = Categoria::create([
            'nombre' => 'Sin Categoria'
        ]);
        $rows = Excel::toArray([], 'public/materias_primas.xlsx');
        foreach ($rows[0] as $row)
        {
            MateriaPrima::create([
                'nombre'            => $row[0],
                'unidad_medida_id'  => $unidad_medida->id,
                'marca_id'          => $marca->id,
                'categoria_id'      => $categoria->id,
                'tipo'              => 1,
                'descripcion'       => '',
                'precio'            => 1,
            ]);
        }
    }
}
