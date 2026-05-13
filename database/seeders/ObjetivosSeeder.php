<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjetivosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('objetivos')->insert([
            ['id_objetivo' =>  1, 'id_eixos' => 1, 'titulo' => 'Digitalizar e automatizar processos administrativos',                      'descricao' => 'Contribui para a ODS 10 e ODS 16, promovendo inclusão digital, participação social e cidadania digital.'],
            ['id_objetivo' =>  2, 'id_eixos' => 1, 'titulo' => 'Ampliar o acesso da população aos serviços digitais',                      'descricao' => 'Contribui para a ODS 10 e ODS 16, promovendo inclusão digital, participação social e cidadania digital.'],
            ['id_objetivo' =>  3, 'id_eixos' => 1, 'titulo' => 'Fortalecer a cidadania digital e a participação do munícipe',             'descricao' => 'Contribui para a ODS 10 e ODS 16, promovendo inclusão digital, participação social e cidadania digital.'],
            ['id_objetivo' =>  4, 'id_eixos' => 2, 'titulo' => 'Integrar e interoperar sistemas municipais',                              'descricao' => 'Reforça o ODS 9 e ODS 16, promovendo interoperabilidade, eficiência e padronização tecnológica.'],
            ['id_objetivo' =>  5, 'id_eixos' => 2, 'titulo' => 'Estruturar cadastros referenciais municipais',                            'descricao' => 'Reforça o ODS 9 e ODS 16, promovendo interoperabilidade, eficiência e padronização tecnológica.'],
            ['id_objetivo' =>  6, 'id_eixos' => 2, 'titulo' => 'Compartilhar plataformas e ferramentas entre secretarias',                'descricao' => 'Reforça o ODS 9 e ODS 16, promovendo interoperabilidade, eficiência e padronização tecnológica.'],
            ['id_objetivo' =>  7, 'id_eixos' => 3, 'titulo' => 'Utilizar dados e inteligência artificial na formulação de políticas públicas', 'descricao' => 'Está alinhado ao ODS 9, incentivando inovação, uso de dados e cidades inteligentes.'],
            ['id_objetivo' =>  8, 'id_eixos' => 3, 'titulo' => 'Implementar soluções de cidades inteligentes',                            'descricao' => 'Está alinhado ao ODS 9, incentivando inovação, uso de dados e cidades inteligentes.'],
            ['id_objetivo' =>  9, 'id_eixos' => 3, 'titulo' => 'Estimular a inovação aberta e o ecossistema local',                       'descricao' => 'Está alinhado ao ODS 9, incentivando inovação, uso de dados e cidades inteligentes.'],
            ['id_objetivo' => 10, 'id_eixos' => 4, 'titulo' => 'Assegurar a segurança da informação e cibersegurança',                    'descricao' => 'Contribui para o ODS 16, sustentando governança, conformidade legal e segurança da informação.'],
            ['id_objetivo' => 11, 'id_eixos' => 4, 'titulo' => 'Fortalecer a governança de dados e conformidade legal',                   'descricao' => 'Contribui para o ODS 16, sustentando governança, conformidade legal e segurança da informação.'],
            ['id_objetivo' => 12, 'id_eixos' => 4, 'titulo' => 'Assegurar confiabilidade e qualidade da informação',                      'descricao' => 'Contribui para o ODS 16, sustentando governança, conformidade legal e segurança da informação.'],
            ['id_objetivo' => 13, 'id_eixos' => 5, 'titulo' => 'Ampliar a transparência ativa e os dados abertos',                        'descricao' => 'Alinha-se ao ODS 16, fortalecendo transparência e participação social.'],
            ['id_objetivo' => 14, 'id_eixos' => 5, 'titulo' => 'Fortalecer a participação social por meios digitais',                     'descricao' => 'Alinha-se ao ODS 16, fortalecendo transparência e participação social.'],
            ['id_objetivo' => 15, 'id_eixos' => 5, 'titulo' => 'Fomentar práticas de gestão transparente e de prestação de contas à sociedade', 'descricao' => 'Alinha-se ao ODS 16, fortalecendo transparência e participação social.'],
            ['id_objetivo' => 16, 'id_eixos' => 6, 'titulo' => 'Assegurar economicidade e sustentabilidade tecnológica',                  'descricao' => 'Reforça ODS 9 e ODS 12, promovendo eficiência, sustentabilidade tecnológica e gestão orientada por resultados.'],
            ['id_objetivo' => 17, 'id_eixos' => 6, 'titulo' => 'Modernizar a infraestrutura tecnológica e conectividade',                 'descricao' => 'Reforça ODS 9 e ODS 12, promovendo eficiência, sustentabilidade tecnológica e gestão orientada por resultados.'],
            ['id_objetivo' => 18, 'id_eixos' => 6, 'titulo' => 'Fortalecer a gestão por resultados e capacitação',                        'descricao' => 'Reforça ODS 9 e ODS 12, promovendo eficiência, sustentabilidade tecnológica e gestão orientada por resultados.'],
        ]);
    }
}
