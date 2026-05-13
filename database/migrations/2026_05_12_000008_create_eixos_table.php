<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eixos', function (Blueprint $table) {
            $table->integer('id_eixos')->autoIncrement();
            $table->string('titulo', 150);
            $table->text('descricao')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eixos');
    }
};
