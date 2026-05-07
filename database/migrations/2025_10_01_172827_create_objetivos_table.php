<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjetivosTable extends Migration
{
    public function up()
    {
        Schema::create('objetivos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eixo_id')->constrained('eixos')->onDelete('cascade')->onUpdate('cascade');
            $table->string('titulo', 150);
            $table->text('descricao')->nullable();
            $table->string('slug', 180)->nullable();
            $table->timestamps();

            $table->unique(['eixo_id','titulo']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('objetivos');
    }
}
