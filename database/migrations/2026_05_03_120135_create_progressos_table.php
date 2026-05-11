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
        Schema::create('progressos', function (Blueprint $table) {
            $table->id();
             $table->string('estado');
             $table->float('pontuacao')->default(0);
              $table->boolean('concluido')->default(false);
              
             $table->foreignId('crianca_id')
             ->constrained('criancas')
              ->onDelete('cascade');

             $table->foreignId('atividade_id')
             ->constrained('atividades')
             ->onDelete('cascade');
              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progressos');
    }
};
