<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('objetivos', function (Blueprint $table) {
            $table->integer('id_objetivo')->autoIncrement();
            $table->integer('id_eixos');
            $table->string('titulo', 150);
            $table->text('descricao')->nullable();

            $table->foreign('id_eixos')
                  ->references('id_eixos')
                  ->on('eixos')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('objetivos');
    }
};
