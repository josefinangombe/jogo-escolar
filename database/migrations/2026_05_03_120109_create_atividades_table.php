<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('atividades', function (Blueprint $table) {

            $table->id();

            $table->text('enunciado');

            // 🎮 tipo de atividade
            $table->string('tipo_interacao');

            // ✍️ escrita pedagógica (copiar / traçar / livre)
            $table->string('modo_escrita')->nullable();

            // 🧠 dados flexíveis (opções, imagens, etc.)
            $table->json('dados')->nullable();

            // 🎯 resposta correta
            $table->text('resposta_correta')->nullable();

            // 🖼️ imagem principal da atividade (IMPORTANTE para RPG)
            $table->string('imagem')->nullable();

            // 🔊 áudio (para atividades de falar)
            $table->string('audio')->nullable();

            // 🔗 relação com nível
            $table->foreignId('nivel_id')
                ->constrained('niveis')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('atividades');
    }
};