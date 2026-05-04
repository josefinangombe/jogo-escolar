<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tema;
use App\Models\Subtema;


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
            'Casa',
            'Divisões da casa',
            'Objetos da casa',
            'Limpeza',
            'Segurança em casa'
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

        $criançaFam = Tema::where('nome', 'A criança e a família')->first();
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
            'Contar objetos',
            'Reconhecer números',
            'Comparação simples',
            'Quantidades',
            'Sequência numérica'
        ]);

        $familiaMat = Tema::where('nome', 'A família')->first();
        $create($familiaMat, [
            'Membros da família (contagem)',
            'Idades',
            'Comparação de tamanhos',
            'Agrupamento',
            'Noções de quantidade'
        ]);

        $habMat = Tema::where('nome', 'A habitação')->first();
        $create($habMat, [
            'Objetos da casa',
            'Formas geométricas na casa',
            'Grande e pequeno',
            'Alto e baixo',
            'Contagem de objetos'
        ]);

        $naturezaMat = Tema::where('nome', 'A natureza e os seus elementos')->first();
        $create($naturezaMat, [
            'Animais (contagem)',
            'Plantas (quantidade)',
            'Elementos naturais',
            'Classificação simples',
            'Comparação'
        ]);


        // =========================
        // EXPRESSÃO PLÁSTICA
        // =========================

        $criançaArte = Tema::where('nome', 'A criança')->first();
        $create($criançaArte, [
            'Desenho livre',
            'Auto-retrato',
            'Cores básicas',
            'Formas simples',
            'Criatividade'
        ]);

        $familiaArte = Tema::where('nome', 'A família')->first();
        $create($familiaArte, [
            'Desenho da família',
            'Cores',
            'Figuras humanas',
            'Recorte simples',
            'Expressão artística'
        ]);

        $habArte = Tema::where('nome', 'A habitação')->first();
        $create($habArte, [
            'Casa desenhada',
            'Objetos da casa',
            'Colagem',
            'Pintura',
            'Criatividade'
        ]);

        $naturezaArte = Tema::where('nome', 'A natureza e os seus elementos')->first();
        $create($naturezaArte, [
            'Animais desenhados',
            'Plantas',
            'Cores da natureza',
            'Pintura livre',
            'Exploração artística'
        ]);
    
    }
}
