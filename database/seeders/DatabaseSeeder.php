<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            /* Tabelas sem dependências externas */
            EixosSeeder::class,
            ObjetivosSeeder::class,
            IniciativasSeeder::class,
            RoadmapSeeder::class,
            AcoesInovacaoSeeder::class,
            RegulamentacoesSeeder::class,
            CategoriasSeeder::class,

            /* Usuários dependem de grupos e setores
               (nullable por enquanto; popular grupos/setores antes de vincular) */
            UserSeeder::class,

            /* Artigos dependem de usuários e categorias */
            // ArtigosSeeder::class,
        ]);
    }
}
