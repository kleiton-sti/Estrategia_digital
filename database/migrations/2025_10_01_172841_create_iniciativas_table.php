<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIniciativasTable extends Migration
{
    public function up()
    {
        Schema::create('iniciativas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 60)->nullable(); // ex: IG-STI-41 (opc)
            $table->string('titulo', 255);
            $table->text('descricao')->nullable();
            $table->foreignId('objetivo_id')->nullable()->constrained('objetivos')->onDelete('set null')->onUpdate('cascade');
            $table->enum('status', ['Não iniciada','Em execução','Concluída'])->default('Não iniciada');
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('iniciativas');
    }
}
