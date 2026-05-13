<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roadmap', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->longText('acao');
            $table->enum('status', ['entregue_recentemente', 'em_andamento', 'explorando']);
            $table->integer('eixo_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('eixo_id')
                  ->references('id_eixos')
                  ->on('eixos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roadmap');
    }
};
