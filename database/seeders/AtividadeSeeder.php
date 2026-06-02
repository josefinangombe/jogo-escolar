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
                    'modo_escrita' => $item['modo_escrita'] ?? null,
                    'imagem' => $item['imagem'] ?? null,
                    'dados' => $item['dados'] ?? null,
                    'resposta_correta' => $item['resposta'] ?? null,
                    'nivel_id' => $nivel->id
                ]);
            }
        };

        /*
        =====================================================
        🌿 PARTES DO CORPO
        =====================================================
        */

        $subtema = Subtema::where('nome', 'Partes do corpo')->first();

        if ($subtema) {

            $niveis = Nivel::where('subtema_id', $subtema->id)
                ->orderBy('ordem')
                ->get();

            foreach ($niveis as $nivel) {

                $create($nivel, [

                    [
                        'enunciado' => 'Toca na imagem da cabeça',
                        'tipo' => 'multipla_escolha',
                        'imagem' => 'corpo/corpo.png',
                        'dados' => [
                            'opcoes' => [
                                [
                                    'nome' => 'Cabeça',
                                    'imagem' => 'corpo/cabeca.png'
                                ],
                                [
                                    'nome' => 'Braço',
                                    'imagem' => 'corpo/braco.png'
                                ],
                                [
                                    'nome' => 'Perna',
                                    'imagem' => 'corpo/perna.png'
                                ]
                            ]
                        ],
                        'resposta' => 'Cabeça'
                    ],

                    // ✅ PINTURA GENÉRICA (NOVO MODELO)
                    [
                        'enunciado' => 'Pinta os braços da criança',
                        'tipo' => 'pintar',
                        'imagem' => 'corpo/bracos.png',
                        'dados' => [
                            'mask' => 'corpo/bracos_mask.png',
                            'zona_alvo' => 'bracos'
                        ],
                        'resposta' => 'bracos'
                    ],

                    [
                        'enunciado' => 'Passa por cima da mão',
                        'tipo' => 'tracado',
                        'imagem' => 'mao_tracejada.png',
                        'dados' => [],
                        'resposta' => 'MÃO'
                    ],

                    [
                        'enunciado' => 'Diz o nome da imagem',
                        'tipo' => 'falar',
                        'imagem' => 'corpo/tronco.png',
                        'dados' => [
                            'audio_texto' => 'Diz: tronco'
                        ],
                        'resposta' => 'tronco'
                    ]
                ]);
            }
        }

        /*
        =====================================================
        🌿 FAMÍLIA
        =====================================================
        */

        $subtema = Subtema::where('nome', 'Membros da família')->first();

        if ($subtema) {

            $niveis = Nivel::where('subtema_id', $subtema->id)
                ->orderBy('ordem')
                ->get();

            foreach ($niveis as $nivel) {

                $create($nivel, [

                    [
                        'enunciado' => 'Toca na imagem da mãe',
                        'tipo' => 'multipla_escolha',
                        'imagem' => 'familia.png',
                        'dados' => [
                            'opcoes' => [
                                [
                                    'nome' => 'Mãe',
                                    'imagem' => 'familia/mae.png'
                                ],
                                [
                                    'nome' => 'Árvore',
                                    'imagem' => 'familia/arvore.png'
                                ],
                                [
                                    'nome' => 'Carro',
                                    'imagem' => 'familia/carro.png'
                                ]
                            ]
                        ],
                        'resposta' => 'Mãe'
                    ],

                    [
                        'enunciado' => 'Copia a palavra: MÃE',
                        'tipo' => 'escrita',
                        'imagem' => 'mae.png',
                        'dados' => [
                            'modo_escrita' => 'copiar'
                        ],
                        'resposta' => 'MÃE'
                    ],

                    [
                        'enunciado' => 'Traça a palavra PAI',
                        'tipo' => 'tracado',
                        'imagem' => 'pai.png',
                        'dados' => [],
                        'resposta' => 'PAI'
                    ],

                    [
                        'enunciado' => 'Diz quem aparece na imagem',
                        'tipo' => 'falar',
                        'imagem' => 'familia2.png',
                        'dados' => [
                            'audio_texto' => 'Diz: família'
                        ],
                        'resposta' => 'família'
                    ]
                ]);
            }
        }

        /*
        =====================================================
        🌿 ANIMAIS
        =====================================================
        */

        $subtema = Subtema::where('nome', 'Animais domésticos')->first();

        if ($subtema) {

            $niveis = Nivel::where('subtema_id', $subtema->id)
                ->orderBy('ordem')
                ->get();

            foreach ($niveis as $nivel) {

                $create($nivel, [

                    [
                        'enunciado' => 'Toca na imagem do cão',
                        'tipo' => 'multipla_escolha',
                        'imagem' => 'animais.png',
                        'dados' => [
                            'opcoes' => [
                                [
                                    'nome' => 'Cão',
                                    'imagem' => 'animais/cao.png'
                                ],
                                [
                                    'nome' => 'Leão',
                                    'imagem' => 'animais/leao.png'
                                ],
                                [
                                    'nome' => 'Tigre',
                                    'imagem' => 'animais/tigre.png'
                                ]
                            ]
                        ],
                        'resposta' => 'Cão'
                    ],

                    [
                        'enunciado' => 'Copia: CÃO',
                        'tipo' => 'escrita',
                        'imagem' => 'cao.png',
                        'dados' => [
                            'modo_escrita' => 'copiar'
                        ],
                        'resposta' => 'CÃO'
                    ],

                    [
                        'enunciado' => 'Traça o cão',
                        'tipo' => 'tracado',
                        'imagem' => 'cao_tracejado.png',
                        'dados' => [],
                        'resposta' => 'CÃO'
                    ],

                    [
                        'enunciado' => 'Fala o nome do animal',
                        'tipo' => 'falar',
                        'imagem' => 'cao.png',
                        'dados' => [
                            'audio_texto' => 'Diz: cão'
                        ],
                        'resposta' => 'cão'
                    ]
                ]);
            }
        }
    }
}