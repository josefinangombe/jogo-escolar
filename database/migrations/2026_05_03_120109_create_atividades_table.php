<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->id();
           $table->text('enunciado');

    // tipos: escrita, desenho, pintura, audio, arrastar, escolha, traçado
    $table->string('tipo_interacao');

    // dados flexíveis (opções, imagens, coordenadas, etc.)
    $table->json('dados')->nullable();

    // resposta esperada (pode ser texto, opção, etc.)
    $table->text('resposta_correta')->nullable();

    $table->foreignId('nivel_id')
        ->constrained('niveis')
        ->onDelete('cascade');

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atividades');
    }
};
