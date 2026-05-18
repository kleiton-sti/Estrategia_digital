<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Artigo;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('artigos', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('titulo');
        });

        // Gera slug para artigos já existentes
        foreach (Artigo::withTrashed()->get() as $artigo) {
            $base = Str::slug($artigo->titulo);
            $slug = $base;
            $i    = 1;
            while (Artigo::withTrashed()->where('slug', $slug)->where('id', '!=', $artigo->id)->exists()) {
                $slug = $base . '-' . $i++;
            }
            $artigo->updateQuietly(['slug' => $slug]);
        }

        Schema::table('artigos', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('artigos', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
