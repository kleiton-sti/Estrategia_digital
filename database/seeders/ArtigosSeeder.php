<?php

namespace Database\Seeders;

use App\Models\Artigo;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArtigosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
       
            foreach (Categoria::all() as $categoria) {
                Artigo::create([
                    'user_id' => User::all()->random()->id,
                    'categoria_id' => $categoria->id,
                    'titulo' => fake()->sentence(),
                    'subtitulo' => fake()->sentence(),
                    'corpo' => fake()->paragraph(),
                ]);
            }
    }
}
