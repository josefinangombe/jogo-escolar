<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subtema;
use App\Models\Nivel;
use App\Models\Atividade;

class AtividadeSeeder extends Seeder
{
    public function run(): void
    {
        $create = function ($nivel, $atividades) {

            foreach ($atividades as $item) {

                Atividade::create([
                    'enunciado' => $item['enunciado'],
                    'tipo_interacao' => $item['tipo'],
                    'dados' => $item['dados'] ?? null,
                    'resposta_correta' => $item['resposta'] ?? null,
                    'nivel_id' => $nivel->id
                ]);
            }
        };

        /*
        =====================================================
        🌿 NATUREZA - A CRIANÇA
        =====================================================
        */

        $subtema = Subtema::where('nome', 'Partes do corpo')->first();

        if ($subtema) {

            $niveis = Nivel::where('subtema_id', $subtema->id)->orderBy('ordem')->get();

            foreach ($niveis as $nivel) {

                $create($nivel, [
                    [
                        'enunciado' => 'Seleciona a parte do corpo correta',
                        'tipo' => 'multipla_escolha',
                        'dados' => [
                            'imagem' => 'corpo.png',
                            'opcoes' => ['Cabeça', 'Braço', 'Perna']
                        ],
                        'resposta' => 'Cabeça'
                    ],
                    [
                        'enunciado' => 'Copia o nome: CABEÇA',
                        'tipo' => 'escrita',
                        'dados' => [
                            'modo_escrita' => 'copiar',
                            'imagem_modelo' => 'cabeca.png'
                        ],
                        'resposta' => 'CABEÇA'
                    ],
                    [
                        'enunciado' => 'Traça a palavra CABEÇA',
                        'tipo' => 'tracado',
                        'dados' => [
                            'imagem_tracejada' => 'cabeca_tracejada.png'
                        ],
                        'resposta' => 'CABEÇA'
                    ],
                    [
                        'enunciado' => 'Diz o nome da imagem',
                        'tipo' => 'falar',
                        'dados' => [
                            'imagem' => 'olho.png',
                            'audio_texto' => 'Diz: olho'
                        ],
                        'resposta' => 'olho'
                    ]
                ]);
            }
        }

        /*
        =====================================================
        🌿 NATUREZA - A FAMÍLIA
        =====================================================
        */

        $subtema = Subtema::where('nome', 'Membros da família')->first();

        if ($subtema) {

            $niveis = Nivel::where('subtema_id', $subtema->id)->orderBy('ordem')->get();

            foreach ($niveis as $nivel) {

                $create($nivel, [
                    [
                        'enunciado' => 'Seleciona quem faz parte da família',
                        'tipo' => 'multipla_escolha',
                        'dados' => [
                            'imagem' => 'familia.png',
                            'opcoes' => ['Mãe', 'Árvore', 'Carro']
                        ],
                        'resposta' => 'Mãe'
                    ],
                    [
                        'enunciado' => 'Copia a palavra: MÃE',
                        'tipo' => 'escrita',
                        'dados' => [
                            'modo_escrita' => 'copiar',
                            'imagem_modelo' => 'mae.png'
                        ],
                        'resposta' => 'MÃE'
                    ],
                    [
                        'enunciado' => 'Traça a palavra PAI',
                        'tipo' => 'tracado',
                        'dados' => [
                            'imagem_tracejada' => 'pai.png'
                        ],
                        'resposta' => 'PAI'
                    ],
                    [
                        'enunciado' => 'Diz quem aparece na imagem',
                        'tipo' => 'falar',
                        'dados' => [
                            'imagem' => 'familia2.png',
                            'audio_texto' => 'Diz: família'
                        ],
                        'resposta' => 'família'
                    ]
                ]);
            }
        }

        /*
        =====================================================
        🌿 NATUREZA - ANIMAIS
        =====================================================
        */

        $subtema = Subtema::where('nome', 'Animais domésticos')->first();

        if ($subtema) {

            $niveis = Nivel::where('subtema_id', $subtema->id)->orderBy('ordem')->get();

            foreach ($niveis as $nivel) {

                $create($nivel, [
                    [
                        'enunciado' => 'Seleciona o animal doméstico',
                        'tipo' => 'multipla_escolha',
                        'dados' => [
                            'imagem' => 'animais.png',
                            'opcoes' => ['Cão', 'Leão', 'Tigre']
                        ],
                        'resposta' => 'Cão'
                    ],
                    [
                        'enunciado' => 'Copia: CÃO',
                        'tipo' => 'escrita',
                        'dados' => [
                            'modo_escrita' => 'copiar',
                            'imagem_modelo' => 'cao.png'
                        ],
                        'resposta' => 'CÃO'
                    ],
                    [
                        'enunciado' => 'Traça o cão',
                        'tipo' => 'tracado',
                        'dados' => [
                            'imagem_tracejada' => 'cao_tracejado.png'
                        ],
                        'resposta' => 'CÃO'
                    ],
                    [
                        'enunciado' => 'Fala o nome do animal',
                        'tipo' => 'falar',
                        'dados' => [
                            'imagem' => 'cao.png',
                            'audio_texto' => 'Diz: cão'
                        ],
                        'resposta' => 'cão'
                    ]
                ]);
            }
        }
    }
}