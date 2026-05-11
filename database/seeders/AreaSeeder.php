<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;
use App\Models\Tema;
use App\Models\Subtema;
use App\Models\Nivel;
use App\Models\Atividade;
class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $areas = [
        'Meio Fisico e Social',
        'Comunicação Linguistica',
        'Representação Matemática',
        'Expressão Plástica'
    ];

    foreach ($areas as $area) {
        Area::create([
            'nome' => $area
        ]);
    }
}
}
