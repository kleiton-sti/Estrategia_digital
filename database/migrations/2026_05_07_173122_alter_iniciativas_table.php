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
        Schema::table('eixos', function (Blueprint $table) {
            $table->removeColumn('objetivo_id');
            $table->unsignedBigInteger('id_objetivo');
            $table->foreign('id_objetivo')->references('id_objetivo')->on('objetivos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('iniciativas',  function (Blueprint $table) {
            $table->renameColumn('id_objetivo', 'objetivo_id');
        });
    }
};
