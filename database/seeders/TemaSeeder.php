<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Area;
use App\Models\Tema;
use App\Models\Subtema;
use App\Models\Nivel;
use App\Models\Atividade;
use App\Models\Progresso;

class TemaSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Progresso::truncate();
        Atividade::truncate();
        Nivel::truncate();
        Subtema::truncate();
        Tema::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 🔥 TEMAS POR ÁREA (DIFERENTES)
        $temasPorArea = [
            'Natureza' => [
                ['nome' => 'A criança', 'imagem' => 'crianca.png'],
                ['nome' => 'A família', 'imagem' => 'familia.png'],
                ['nome' => 'Os animais', 'imagem' => 'animais.png'],
                ['nome' => 'As plantas', 'imagem' => 'plantas.png'],
            ],

            'Português' => [
                ['nome' => 'Escrita', 'imagem' => 'escrita.png'],
                ['nome' => 'Leitura', 'imagem' => 'leitura.png'],
                ['nome' => 'Grafismo', 'imagem' => 'grafismo.png'],
                ['nome' => 'Compreensão', 'imagem' => 'compreensao.png'],
            ],

            'Matemática' => [
                ['nome' => 'Noções', 'imagem' => 'nocoes.png'],
                ['nome' => 'Números', 'imagem' => 'numeros.png'],
                ['nome' => 'Figuras Geométricas', 'imagem' => 'geometria.png'],
                ['nome' => 'Conjuntos', 'imagem' => 'conjuntos.png'],
            ],

            'Plástica' => [
                ['nome' => 'Desenho', 'imagem' => 'desenho.png'],
                ['nome' => 'Pintura', 'imagem' => 'pintura.png'],
                ['nome' => 'Recorte', 'imagem' => 'recorte.png'],
                ['nome' => 'Criatividade', 'imagem' => 'criatividade.png'],
            ],
        ];

        // 🔍 buscar áreas
        $areas = Area::all()->keyBy('nome');

        foreach ($temasPorArea as $areaNome => $temas) {

            if (!isset($areas[$areaNome])) {
                continue;
            }

            $area = $areas[$areaNome];

            foreach ($temas as $tema) {
                Tema::create([
                    'nome' => $tema['nome'],
                    'imagem' => $tema['imagem'],
                    'area_id' => $area->id,
                ]);
            }
        }
    }
}