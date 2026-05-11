<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;
use App\Models\Tema;
use App\Models\Subtema;
use App\Models\Nivel;
use App\Models\Atividade;
class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $createSubtema = function ($tema, $subtemas) {

            foreach ($subtemas as $nomeSubtema) {

                $subtema = Subtema::create([
                    'nome' => $nomeSubtema,
                    'tema_id' => $tema->id
                ]);

                
                for ($i = 1; $i <= 6; $i++) {
                    Nivel::create([
                        'nome' => "Nível $i",
                        'subtema_id' => $subtema->id
                    ]);
                }
            }
        };

        // =========================
        // Meio Físico e Social
        // =========================

        $criança = Tema::where('nome', 'A criança')->first();
        $createSubtema($criança, [
            'Partes do corpo',
            'Órgãos dos sentidos',
            'Higiene pessoal',
            'Gostos e preferências',
            'Direitos e deveres'
        ]);

        $familia = Tema::where('nome', 'A família')->first();
        $createSubtema($familia, [
            'Membros da família',
            'Família restrita',
            'Família alargada',
            'Funções familiares',
            'Importância da família'
        ]);

        $habitação = Tema::where('nome', 'A habitação')->first();
        $createSubtema($habitação, [
            'Tipos de habitação',
            'Compartimentos da casa',
            'Mobiliário',
            'Tarefas domésticas',
            'Materiais de construção'
        ]);

        $natureza = Tema::where('nome', 'A natureza e os seus elementos')->first();
        $createSubtema($natureza, [
            'Animais',
            'Plantas',
            'Água',
            'Sol e chuva',
            'Cuidado com o ambiente'
        ]);


        // =========================
        //  Comunicação Linguística
        // =========================

        $criançaFam = Tema::where('nome', 'A criança e a família')->first();

        if ($criançaFam) {
            $createSubtema($criançaFam, [
                'Apresentação pessoal',
                'Nome próprio',
                'Diálogo simples',
                'Expressão oral',
                'Interação social'
            ]);
        }

        $preEscrita = Tema::where('nome', 'A pré-escrita, a escrita e a leitura')->first();

        if ($preEscrita) {
            $createSubtema($preEscrita, [
                'Letras do alfabeto',
                'Sons das letras',
                'Traços e linhas',
                'Escrita do nome',
                'Leitura de imagens'
            ]);
        }


        // =========================
        // Representação Matemática
        // =========================

        $mat = Tema::where('nome', 'A criança')->first();

        $createSubtema($mat, [
            'Noções básicas',
            'Conjuntos',
            'Números naturais',
            'Figuras geométricas',
            'Aritmética'
        ]);


        // =========================
        // Expressão Plástica
        // =========================

        $arte = Tema::where('nome', 'A criança')->first();

        $createSubtema($arte, [
            'Desenho',
            'Pintura',
            'Cores',
            'Formas',
            'Grafismo'
        ]);
    }
}

