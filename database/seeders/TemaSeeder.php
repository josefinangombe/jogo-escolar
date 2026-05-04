<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;
use App\Models\Tema;


class TemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // MEIO FÍSICO E SOCIAL

        $mfs = Area::where('nome', 'Meio Fisico e Social')->first();

        Tema::create(['nome' => 'A criança ', 'area_id' => $mfs->id]);
        Tema::create(['nome' => 'A família', 'area_id' => $mfs->id]);
        Tema::create(['nome' => 'A habitação', 'area_id' => $mfs->id]);
        Tema::create(['nome' => 'A natureza e os seus elementos', 'area_id' => $mfs->id]);

        // =========================
        // COMUNICAÇÃO LINGUÍSTICA
        // =========================
        $lingua = Area::where('nome', 'Comunicação Linguistica')->first();

        Tema::create(['nome' => 'A criança e a família', 'area_id' => $lingua->id]);
        Tema::create(['nome' => 'A habitação', 'area_id' => $lingua->id]);
        Tema::create(['nome' => 'A natureza e os seus elementos', 'area_id' => $lingua->id]);
        Tema::create(['nome' => 'A pré-escrita, a escrita e a leitura', 'area_id' => $lingua->id]);

        // =========================
        // REPRESENTAÇÃO MATEMÁTICA
        // =========================
        $mat = Area::where('nome', 'Representação Matemática')->first();

        Tema::create(['nome' => 'A criança', 'area_id' => $mat->id]);
        Tema::create(['nome' => 'A família', 'area_id' => $mat->id]);
        Tema::create(['nome' => 'A habitação', 'area_id' => $mat->id]);
        Tema::create(['nome' => 'A natureza e os seus elementos', 'area_id' => $mat->id]);

        // =========================
        // EXPRESSÃO PLÁSTICA
        // =========================
        $arte = Area::where('nome', 'Expressão Plástica')->first();

        Tema::create(['nome' => 'A criança', 'area_id' => $arte->id]);
        Tema::create(['nome' => 'A família', 'area_id' => $arte->id]);
        Tema::create(['nome' => 'A habitação', 'area_id' => $arte->id]);
        Tema::create(['nome' => 'A natureza e os seus elementos', 'area_id' => $arte->id]);
    
    }
}
