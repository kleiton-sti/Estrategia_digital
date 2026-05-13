<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grupos_permissoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_id')->constrained('grupos');
            $table->foreignId('permissao_id')->constrained('permissoes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grupos_permissoes');
    }
};
