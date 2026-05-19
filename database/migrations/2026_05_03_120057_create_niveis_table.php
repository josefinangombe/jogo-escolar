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
    Schema::create('niveis', function (Blueprint $table) {
        $table->id();

        $table->string('nome');

        // 🎮 NOVO (RPG)
        $table->integer('ordem')->default(1);
        $table->boolean('desbloqueado')->default(true);

        // (opcional: podes manter se quiseres evolução futura)
        $table->integer('idade_min')->nullable();
        $table->integer('idade_max')->nullable();

        $table->foreignId('subtema_id')
            ->constrained('subtemas')
            ->onDelete('cascade');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveis');
    }
};
