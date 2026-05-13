<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('level', 50);
            $table->string('user', 50);
            $table->string('ip', 50)->nullable();
            $table->text('message');
            $table->string('entity_type', 50)->nullable();
            $table->integer('entity_id')->default(0)->nullable();
            $table->text('context')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
