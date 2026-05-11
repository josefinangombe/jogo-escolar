<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;
use App\Models\Tema;
use App\Models\Subtema;
use App\Models\Nivel;
use App\Models\Atividade;

class AtividadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
         public function run(): void
    {
        $create = function ($nivel, $atividades) {
            foreach ($atividades as $item) {
                Atividade::create([
                    'enunciado' => $item['enunciado'],
                    'tipo_interacao' => $item['tipo'],
                    
                    'dados' => isset($item['dados'])
                    ? json_encode($item['dados'])
                    : null,

                'resposta_correta' => $item['resposta'] ?? null,
                'nivel_id' => $nivel->id
            ]);
        }
    };


        /*
        =========================
        NÍVEL 1 - EXEMPLO INFANTIL
        =========================
        */

        $nivel1 = Nivel::where('nome', 'Nível 1')->first();

        if ($nivel1) {

            $create($nivel1, [

                // ✔ SELEÇÃO
                [
                    'enunciado' => 'Qual é a cor do sol?',
                    'tipo' => 'multipla_escolha',
                    'dados' => [
                        'opcoes' => ['Amarelo', 'Azul', 'Verde']
                    ],
                    'resposta' => 'Amarelo'
                ],

                // ✔ ESCRITA
                [
                    'enunciado' => 'Escreve o nome da tua família',
                    'tipo' => 'escrita',
                    'dados' => [
                        'dica' => 'Ex: mãe, pai...'
                    ],
                    'resposta' => null
                ],

                // ✔ TRAÇAR
                [
                    'enunciado' => 'Traça a letra A',
                    'tipo' => 'tracado',
                    'dados' => [
                        'letra' => 'A'
                    ],
                    'resposta' => 'A'
                ],

                // ✔ DESENHO
                [
                    'enunciado' => 'Desenha uma casa',
                    'tipo' => 'desenho',
                    'dados' => [
                        'forma' => 'casa'
                    ],
                    'resposta' => null
                ],

                // ✔ PINTURA
                [
                    'enunciado' => 'Pinta a bola de vermelho',
                    'tipo' => 'pintura',
                    'dados' => [
                        'objeto' => 'bola',
                        'cores' => ['vermelho', 'azul', 'verde']
                    ],
                    'resposta' => 'vermelho'
                ],
            ]);
        }
    }
}

