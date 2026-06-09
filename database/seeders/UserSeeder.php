<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // // Usuário de teste 1
        // User::create([
        //     'registro' => '28544',
        //     'cargo' => 'Secretário de Tecnologia',
        //     'nome' => 'Rubens Costa',
        //     'email' => 'rubens.costa@caraguatatuba.sp.gov.br',
        //     'cpf' => '37723454848',
        //     'password' => Hash::make('Costa28523'),
        //     'email_verified_at' => now(),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     'deleted_at' => null,
        //     'remember_token' => Str::random(10),
        //     'grupo_id' => null,
        //     'setor_id' => null,
        // ]);

        // // Usuário de teste 2
        // User::create([
        //     'registro' => '28523',
        //     'cargo' => 'Chefe da área de dados',
        //     'nome' => 'Tiago Santos Braun',
        //     'email' => 'maria@example.com',
        //     'cpf' => '30045994811',
        //     'password' => Hash::make('Braun23599'),
        //     'email_verified_at' => now(),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     'deleted_at' => null,
        //     'remember_token' => Str::random(10),
        //     'grupo_id' => null,
        //     'setor_id' => null,
        // ]);

        // // Usuário de teste 3
        // User::create([
        //     'registro' => '07717',
        //     'cargo' => "Chefe de operações",
        //     'nome' => 'Marcio Luis Rodrigues de Paula Lima',
        //     'email' => 'marcio.paula@caraguatatuba.sp.gov.br',
        //     'cpf' => '16162931870',
        //     'password' => Hash::make('Rodrigues17931'),
        //     'email_verified_at' => now(),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     'deleted_at' => null,
        //     'remember_token' => Str::random(10),
        //     'grupo_id' => null,
        //     'setor_id' => null,
        // ]);

        // // Usuário admin
        // User::create([
        //     'registro' => '13174',
        //     'cargo' => 'Chefe de transformação digital',
        //     'nome' => 'Alexandre Gudin Novak',
        //     'email' => 'alexandre.novak@caraguatatuba.sp.gov.br',
        //     'cpf' => '21571501886',
        //     'password' => Hash::make('Novak74501'),
        //     'email_verified_at' => now(),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     'deleted_at' => null,
        //     'remember_token' => Str::random(10),
        //     'grupo_id' => null,
        //     'setor_id' => null,
        // ]);

        // // Usuário de teste 4
        // User::create([
        //     'registro' => '25606',
        //     'nome' => 'Kleiton Silva Ferreira',
        //     'email' => 'kleiton.silva@caraguatatuba.gov.br',
        //     'cpf' => '09906847417',
        //     'password' => Hash::make('Kleiton123'),
        //     'email_verified_at' => now(),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     'deleted_at' => null,
        //     'remember_token' => Str::random(10),
        //     'grupo_id' => null,
        //     'setor_id' => null,
        // ]);

        User::create([
            'registro' => '25676',
            'cargo' => 'Chefe da Área Administração',
            'nome' => 'Ligia Mendes Felix',
            'email' => 'ligia.felix@caraguatatuba.sp.gov.br',
            'cpf' => '29091613823',
            'password' => Hash::make('Felix25676'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            'remember_token' => Str::random(10),
            'grupo_id' => null,
            'setor_id' => null,
        ]);
    }
}
