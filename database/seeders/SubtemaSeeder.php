<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;
use App\Models\Tema;
use App\Models\Subtema;
use App\Models\Nivel;
use App\Models\Atividade;

class SubtemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $create = function ($tema, $subtemas) {
            foreach ($subtemas as $nome) {
                Subtema::create([
                    'nome' => $nome,
                    'tema_id' => $tema->id
                ]);
            }
        };

        // =========================
        // MEIO FÍSICO E SOCIAL
        // =========================

        $criança = Tema::where('nome', 'A criança')->first();
        $create($criança, [
            'Partes do corpo',
            'Os órgãos dos sentidos',
            'Habito de higiene',
            'Seus gostos e suas preferências',
            'Direitos e deveres das crianças'
        ]);

        $familia = Tema::where('nome', 'A família')->first();
        $create($familia, [
            'Membros da família',
            ' Família restrita',
            ' Família alargada',
            ' Funções dos membros da família',
            ' Importância da família'
        ]);

        $habitação = Tema::where('nome', 'A habitação')->first();
        $create($habitação, [
            'Tipos de habitação',
            'Compartimentos da casa',
            'Mobiliário da casa',
            'Tarefas domésticas',
            'Materiais de construção'
        ]);

        $natureza = Tema::where('nome', 'A natureza e os seus elementos')->first();
        $create($natureza, [
            'Animais',
            'Plantas',
            'Água',
            'Sol e chuva',
            'Cuidado com o ambiente'
        ]);


        // =========================
        // COMUNICAÇÃO LINGUÍSTICA
        // =========================

        $criançaFam = Tema::where('nome', 'A criança')->first();
        $create($criançaFam, [
            'Apresentação pessoal',
            'Nome próprio',
            'Diálogo simples',
            'Expressão oral',
            'Interação social'
        ]);

        $habLingua = Tema::where('nome', 'A habitação')->first();
        $create($habLingua, [
            'Objetos da casa',
            'Descrição da casa',
            'Vocabulário simples',
            'Frases curtas',
            'Comunicação oral'
        ]);

        $naturezaLingua = Tema::where('nome', 'A natureza e os seus elementos')->first();
        $create($naturezaLingua, [
            'Animais',
            'Plantas',
            'Clima',
            'Elementos naturais',
            'Descrição oral'
        ]);

        $preEscrita = Tema::where('nome', 'A pré-escrita, a escrita e a leitura')->first();
        $create($preEscrita, [
            'Letras do alfabeto',
            'Sons das letras',
            'Traços e linhas',
            'Escrita do nome',
            'Leitura de imagens'
        ]);


        // =========================
        // REPRESENTAÇÃO MATEMÁTICA
        // =========================

        $criançaMat = Tema::where('nome', 'A criança')->first();
        $create($criançaMat, [
            'Noções',
            'Os conjuntos',
            'Numeros naturais',
            'Figuras geométricas',
            'Aritmetica'
        ]);

        $familiaMat = Tema::where('nome', 'A família')->first();
        $create($familiaMat, [
            'Noções',
            'Os conjuntos',
            'Numeros naturais',
            'Figuras geométricas',
            'Aritmetica'
        ]);

        $habMat = Tema::where('nome', 'A habitação')->first();
        $create($habMat, [
           'Noções',
            'Os conjuntos',
            'Numeros naturais',
            'Figuras geométricas',
            'Aritmetica'
        ]);

        $naturezaMat = Tema::where('nome', 'A natureza e os seus elementos')->first();
        $create($naturezaMat, [
                'Noções',
                'Os conjuntos',
                'Numeros naturais',
                'Figuras geométricas',
                'Aritmetica'
        ]);


        // =========================
        // EXPRESSÃO PLÁSTICA
        // =========================

        $criançaArte = Tema::where('nome', 'A criança')->first();
        $create($criançaArte, [
            'Desenho',
            'Pintura',
            'Cores',
             'Formas',
            'Grafismo'
        ]);

        $familiaArte = Tema::where('nome', 'A família')->first();
        $create($familiaArte, [
           'Desenho',
            'Pintura',
            'Cores',
             'Formas',
            'Grafismo'
        ]);

        $habArte = Tema::where('nome', 'A habitação')->first();
        $create($habArte, [
            'Desenho',
            'Pintura',
            'Cores',
             'Formas',
            'Grafismo'
        ]);

        $naturezaArte = Tema::where('nome', 'A natureza e os seus elementos')->first();
        $create($naturezaArte, [
            'Desenho',
            'Pintura',
            'Cores',
             'Formas',
            'Grafismo'
        ]);
    
    }
}
