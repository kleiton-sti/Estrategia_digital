<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEixosTable extends Migration
{
    public function up()
    {
        Schema::create('eixos', function (Blueprint $table) {
            $table->id(); // id -> id
            $table->string('titulo', 150)->unique();
            $table->string('slug', 160)->unique();
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('eixos');
    }
}
