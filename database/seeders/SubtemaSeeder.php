<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tema;
use App\Models\Subtema;

class SubtemaSeeder extends Seeder
{
    public function run(): void
    {
        $temas = Tema::with('area')->get();

        // 🔍 função segura para encontrar tema por nome + área
        $findTema = function ($nome, $areaNome) use ($temas) {
            return $temas->first(function ($tema) use ($nome, $areaNome) {
                return $tema->nome === $nome &&
                       $tema->area->nome === $areaNome;
            });
        };

        $create = function ($tema, $subtemas, $label) {
            if (!$tema) {
                throw new \Exception("Tema '{$label}' não encontrado.");
            }

            foreach ($subtemas as $nome) {
                Subtema::create([
                    'nome' => $nome,
                    'tema_id' => $tema->id
                ]);
            }
        };

        /*
        =====================================================
                        🌿 NATUREZA
        =====================================================
        */

        $create($findTema('A criança', 'Natureza'), [
            'Partes do corpo',
            'Órgãos dos sentidos',
            'Higiene pessoal',
            'Direitos da criança',
            'Cuidados com o corpo'
        ], 'A criança - Natureza');

        $create($findTema('A família', 'Natureza'), [
            'Membros da família',
            'Tipos de família',
            'Funções familiares',
            'Importância da família',
            'Respeito e convivência'
        ], 'A família - Natureza');

        $create($findTema('Os animais', 'Natureza'), [
            'Animais domésticos',
            'Animais selvagens',
            'Alimentação dos animais',
            'Habitat dos animais',
            'Cuidados com os animais'
        ], 'Os animais - Natureza');

        $create($findTema('As plantas', 'Natureza'), [
            'Partes das plantas',
            'Crescimento das plantas',
            'Tipos de plantas',
            'Importância das plantas',
            'Cuidados com plantas'
        ], 'As plantas - Natureza');

        /*
        =====================================================
                        📘 PORTUGUÊS
        =====================================================
        */

        $create($findTema('Escrita', 'Português'), [
            'Alfabeto',
            'Formação de palavras',
            'Frases simples',
            'Ortografia básica',
            'Produção textual'
        ], 'Escrita - Português');

        $create($findTema('Leitura', 'Português'), [
            'Reconhecimento de palavras',
            'Leitura de frases',
            'Interpretação simples',
            'Compreensão de textos',
            'Leitura em voz alta'
        ], 'Leitura - Português');

        $create($findTema('Grafismo', 'Português'), [
            'Traços básicos',
            'Coordenação motora',
            'Escrita de letras',
            'Desenho de formas',
            'Pre-escrita'
        ], 'Grafismo - Português');

        $create($findTema('Compreensão', 'Português'), [
            'Interpretação oral',
            'Compreensão de histórias',
            'Vocabulário',
            'Perguntas e respostas',
            'Expressão oral'
        ], 'Compreensão - Português');

        /*
        =====================================================
                        ➗ MATEMÁTICA
        =====================================================
        */

        $create($findTema('Noções', 'Matemática'), [
            'Grande e pequeno',
            'Mais e menos',
            'Dentro e fora',
            'Perto e longe',
            'Antes e depois'
        ], 'Noções - Matemática');

        $create($findTema('Números', 'Matemática'), [
            'Contagem',
            'Números de 1 a 10',
            'Números de 1 a 100',
            'Escrita de números',
            'Comparação de números'
        ], 'Números - Matemática');

        $create($findTema('Figuras Geométricas', 'Matemática'), [
            'Círculo',
            'Quadrado',
            'Triângulo',
            'Retângulo',
            'Identificação de formas'
        ], 'Geometria - Matemática');

        $create($findTema('Conjuntos', 'Matemática'), [
            'Agrupamento',
            'Classificação',
            'Comparação',
            'União de conjuntos',
            'Separação de objetos'
        ], 'Conjuntos - Matemática');

        /*
        =====================================================
                        🎨 PLÁSTICA
        =====================================================
        */

        $create($findTema('Desenho', 'Plástica'), [
            'Desenho livre',
            'Desenho de objetos',
            'Formas básicas',
            'Coordenação motora',
            'Criatividade'
        ], 'Desenho - Plástica');

        $create($findTema('Pintura', 'Plástica'), [
            'Cores primárias',
            'Mistura de cores',
            'Pintura livre',
            'Uso de pincel',
            'Expressão artística'
        ], 'Pintura - Plástica');

        $create($findTema('Recorte', 'Plástica'), [
            'Uso da tesoura',
            'Recorte de formas',
            'Colagem',
            'Montagem de figuras',
            'Coordenação motora'
        ], 'Recorte - Plástica');

        $create($findTema('Criatividade', 'Plástica'), [
            'Criação livre',
            'Materiais recicláveis',
            'Construção de objetos',
            'Expressão artística',
            'Imaginação'
        ], 'Criatividade - Plástica');
    }
}