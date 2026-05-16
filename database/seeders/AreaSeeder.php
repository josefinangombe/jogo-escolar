<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Area::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $areas = [
            ['nome' => 'Natureza', 'imagem' => 'natureza.png'],
            ['nome' => 'Português', 'imagem' => 'portugues.png'],
            ['nome' => 'Matemática', 'imagem' => 'matematica.png'],
            ['nome' => 'Plástica', 'imagem' => 'plastica.png'],
        ];

        foreach ($areas as $area) {
            Area::create([
                'nome' => $area['nome'],
                'imagem' => $area['imagem'],
            ]);
        }
    }
}

