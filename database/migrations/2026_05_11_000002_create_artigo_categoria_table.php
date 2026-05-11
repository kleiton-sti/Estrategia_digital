<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /* Tabela associativa para a relação N:N entre artigos e categorias */
        Schema::create('artigo_categoria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artigo_id')
                ->constrained('artigos')
                ->onDelete('cascade');
            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->onDelete('cascade');
            $table->timestamps();

            $table->unique(['artigo_id', 'categoria_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artigo_categoria');
    }
};
