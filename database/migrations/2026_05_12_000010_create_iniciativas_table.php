<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('iniciativas', function (Blueprint $table) {
            $table->integer('id_iniciativas')->autoIncrement();
            $table->integer('id_objetivo');
            $table->string('titulo', 150);
            $table->text('descricao')->nullable();
            $table->enum('status', ['Não iniciada', 'Em execução', 'Concluída'])->default('Não iniciada');

            $table->foreign('id_objetivo')
                  ->references('id_objetivo')
                  ->on('objetivos')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('iniciativas');
    }
};
