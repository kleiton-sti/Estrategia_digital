<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('setores', function (Blueprint $table) {
            $table->id();
            $table->string('setor', 50);
            $table->foreignId('unidade_id')->constrained('unidades');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('setores');
    }
};
