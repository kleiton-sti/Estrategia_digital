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
        // Usuário de teste 1
        User::create([
            'registro' => '2025001',
            'nome' => 'João Silva',
            'email' => 'joao@example.com',
            'cpf' => '12345678901',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            'remember_token' => Str::random(10),
            'grupo_id' => null,
            'setor_id' => null,
        ]);

        // Usuário de teste 2
        User::create([
            'registro' => '2025002',
            'nome' => 'Maria Santos',
            'email' => 'maria@example.com',
            'cpf' => '98765432109',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            'remember_token' => Str::random(10),
            'grupo_id' => null,
            'setor_id' => null,
        ]);

        // Usuário de teste 3
        User::create([
            'registro' => '2025003',
            'nome' => 'Pedro Oliveira',
            'email' => 'pedro@example.com',
            'cpf' => '55544433322',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            'remember_token' => Str::random(10),
            'grupo_id' => null,
            'setor_id' => null,
        ]);

        // Usuário admin
        User::create([
            'registro' => '2025000',
            'nome' => 'Admin User',
            'email' => 'admin@example.com',
            'cpf' => '11111111111',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            'remember_token' => Str::random(10),
            'grupo_id' => null,
            'setor_id' => null,
        ]);

        // Usuário de teste 4
        User::create([
            'registro' => '2025004',
            'nome' => 'Ana Costa',
            'email' => 'ana@example.com',
            'cpf' => '99988877766',
            'password' => Hash::make('password123'),
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
