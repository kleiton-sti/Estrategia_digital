<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regulamentacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 255);
            $table->string('descricao', 255);
            $table->string('link', 255)->nullable();
            $table->date('publicado_em')->nullable();
            $table->tinyInteger('pendente')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regulamentacoes');
    }
};
