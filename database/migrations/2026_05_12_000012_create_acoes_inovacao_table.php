<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acoes_inovacao', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('acao', 255);
            $table->tinyInteger('status_2024');
            $table->tinyInteger('status_2025');
            $table->date('data_conclusao')->nullable();
            $table->enum('categoria', [
                'servicos_online',
                'participacao_do_cidadao',
                'sistemas_digitais',
                'adequacao_municipal',
            ]);
            $table->tinyInteger('realizado_2025')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acoes_inovacao');
    }
};
