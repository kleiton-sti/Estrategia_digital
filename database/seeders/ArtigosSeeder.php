<?php

namespace Database\Seeders;

use App\Models\Artigo;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArtigosSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = Categoria::all();
        $users      = User::all();

        foreach ($categorias as $categoria) {
            $artigo = Artigo::create([
                'user_id'  => $users->random()->id,
                'titulo'   => fake()->sentence(),
                'subtitulo'=> fake()->sentence(),
                'corpo'    => fake()->paragraph(),
            ]);

            $artigo->categorias()->attach($categoria->id);
        }
    }
}
