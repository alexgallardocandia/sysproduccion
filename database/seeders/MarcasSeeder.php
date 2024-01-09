<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Excel::load(file('public/marcas.xlsx'))->get();
        // $marcas = array_map('str_getcsv', explode("\n", $data));

        foreach ($data as $marca) {
            Marca::create([
                'nombre' => $marca[0]
            ]);
        }
    }
}
