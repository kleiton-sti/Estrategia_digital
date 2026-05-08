<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nome= [ 'Sistemas', 'Infraestrutura', 'Manutenção', 'Segurança', 'Outros' ];

        for($i = 0; $i < count($nome); $i++){
            $categoria = new Categoria();
            $categoria->nome = $nome[$i];
            $categoria->save();
        }
    }
            
}