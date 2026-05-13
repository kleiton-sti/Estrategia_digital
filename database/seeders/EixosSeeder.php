<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EixosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('eixos')->insert([
            ['id_eixos' => 1, 'titulo' => 'Gestão Centrada no Munícipe',      'descricao' => 'Visa colocar o cidadão no centro da transformação digital, assegurando que os serviços públicos sejam simples, acessíveis e inclusivos, promovendo maior participação social e cidadania digital.'],
            ['id_eixos' => 2, 'titulo' => 'Gestão Integrada',                 'descricao' => 'Focado na integração e interoperabilidade dos sistemas municipais, estaduais e federais, assegurando eficiência administrativa, padronização tecnológica e eliminação de redundâncias.'],
            ['id_eixos' => 3, 'titulo' => 'Gestão Inteligente',               'descricao' => 'Promove o uso de dados, inteligência artificial e soluções inovadoras para apoiar a tomada de decisão, ampliar a eficiência da gestão e implementar soluções de cidades inteligentes.'],
            ['id_eixos' => 4, 'titulo' => 'Gestão Confiável',                 'descricao' => 'Busca fortalecer a segurança da informação, a governança de dados e a confiabilidade dos sistemas, assegurando conformidade legal e proteção às informações do município e do cidadão.'],
            ['id_eixos' => 5, 'titulo' => 'Gestão Transparente e Aberta',    'descricao' => 'Prioriza a transparência ativa, o acesso a dados públicos e o fortalecimento de canais digitais de participação social, ampliando os mecanismos de controle social e accountability.'],
            ['id_eixos' => 6, 'titulo' => 'Gestão Eficiente',                 'descricao' => 'Tem como foco a sustentabilidade e a economicidade no uso da tecnologia, a modernização da infraestrutura e a capacitação dos servidores, consolidando uma gestão pública orientada por resultados.'],
        ]);
    }
}
