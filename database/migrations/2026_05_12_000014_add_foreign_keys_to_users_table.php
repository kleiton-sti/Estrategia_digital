<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('grupo_id')->references('id')->on('grupos')->nullOnDelete();
            $table->foreign('setor_id')->references('id')->on('setores')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['grupo_id']);
            $table->dropForeign(['setor_id']);
        });
    }
};
