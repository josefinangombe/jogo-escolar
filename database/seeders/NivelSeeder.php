<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tema;
use App\Models\Subtema;
use App\Models\Nivel;

class NivelSeeder extends Seeder
{
    public function run(): void
    {
        $temas = Tema::with('area')->get();

        // 🔍 encontrar tema de forma segura
        $findTema = function ($nome, $areaNome) use ($temas) {
            return $temas->first(function ($tema) use ($nome, $areaNome) {
                return $tema->nome === $nome &&
                       $tema->area->nome === $areaNome;
            });
        };

        $createSubtema = function ($tema, $subtemas, $label) {

            if (!$tema) {
                throw new \Exception("Tema '{$label}' não encontrado.");
            }

            foreach ($subtemas as $nomeSubtema) {

                $subtema = Subtema::create([
                    'nome' => $nomeSubtema,
                    'tema_id' => $tema->id
                ]);

                for ($i = 1; $i <= 6; $i++) {
                    Nivel::create([
                        'nome' => "Nível {$i}",
                        'subtema_id' => $subtema->id
                    ]);
                }
            }
        };

        /*
        =========================
        🌿 NATUREZA
        =========================
        */

        $createSubtema(
            $findTema('A criança', 'Natureza'),
            [
                'Partes do corpo',
                'Órgãos dos sentidos',
                'Higiene pessoal',
                'Gostos e preferências',
                'Direitos e deveres'
            ],
            'A criança - Natureza'
        );

        $createSubtema(
            $findTema('A família', 'Natureza'),
            [
                'Membros da família',
                'Família restrita',
                'Família alargada',
                'Funções familiares',
                'Importância da família'
            ],
            'A família - Natureza'
        );

        $createSubtema(
            $findTema('Os animais', 'Natureza'),
            [
                'Animais domésticos',
                'Animais selvagens',
                'Alimentação',
                'Habitat',
                'Cuidados com animais'
            ],
            'Animais - Natureza'
        );

        /*
        =========================
        📘 PORTUGUÊS
        =========================
        */

        $createSubtema(
            $findTema('Escrita', 'Português'),
            [
                'Alfabeto',
                'Palavras',
                'Frases',
                'Ortografia',
                'Produção textual'
            ],
            'Escrita - Português'
        );

        $createSubtema(
            $findTema('Leitura', 'Português'),
            [
                'Leitura de palavras',
                'Leitura de frases',
                'Interpretação',
                'Compreensão',
                'Expressão oral'
            ],
            'Leitura - Português'
        );

        /*
        =========================
        ➗ MATEMÁTICA
        =========================
        */

        $createSubtema(
            $findTema('Números', 'Matemática'),
            [
                'Contagem',
                'Soma',
                'Subtração',
                'Multiplicação',
                'Problemas'
            ],
            'Números - Matemática'
        );

        $createSubtema(
            $findTema('Figuras Geométricas', 'Matemática'),
            [
                'Círculo',
                'Quadrado',
                'Triângulo',
                'Retângulo',
                'Formas no dia a dia'
            ],
            'Geometria - Matemática'
        );

        /*
        =========================
        🎨 PLÁSTICA
        =========================
        */

        $createSubtema(
            $findTema('Desenho', 'Plástica'),
            [
                'Desenho livre',
                'Formas',
                'Cores',
                'Criatividade',
                'Expressão artística'
            ],
            'Desenho - Plástica'
        );
    }
}