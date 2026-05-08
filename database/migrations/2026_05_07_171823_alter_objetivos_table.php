<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('objetivos', function (Blueprint $table) {
            $table->renameColumn('id','id_objetivo');
            $table->removeColumn('eixo_id');
            $table->unsignedBigInteger('id_eixos');
            $table->foreign('id_eixos')->references('id_eixos')->on('eixos')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(['id_eixos','titulo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('objetivos', function (Blueprint $table) {
            $table->renameColumn('id_eixos', 'eixo_id');
        });
    }
};
