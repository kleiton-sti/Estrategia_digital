<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcoesInovacaoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('acoes_inovacao')->insert([
            ['id' =>  1, 'acao' => 'Canal de denúncias',                                          'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'servicos_online',         'realizado_2025' => 0],
            ['id' =>  2, 'acao' => 'Certidões',                                                   'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'servicos_online',         'realizado_2025' => 0],
            ['id' =>  3, 'acao' => 'Consulta a status de protocolos',                             'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'servicos_online',         'realizado_2025' => 0],
            ['id' =>  4, 'acao' => 'Consulta de débitos municipais',                              'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'servicos_online',         'realizado_2025' => 0],
            ['id' =>  5, 'acao' => 'Emissão de guias/boletos dos débitos municipais',             'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'servicos_online',         'realizado_2025' => 0],
            ['id' =>  6, 'acao' => 'Inscrições em oficinas, cursos, eventos e vagas',             'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'servicos_online',         'realizado_2025' => 0],
            ['id' =>  7, 'acao' => 'Licenças / autorizações',                                     'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'servicos_online',         'realizado_2025' => 0],
            ['id' =>  8, 'acao' => 'Nota fiscal eletrônica',                                      'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'servicos_online',         'realizado_2025' => 0],
            ['id' =>  9, 'acao' => 'Ouvidoria',                                                   'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'servicos_online',         'realizado_2025' => 0],
            ['id' => 10, 'acao' => 'Pesquisa de satisfação em relação aos serviços prestados pela Prefeitura', 'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'servicos_online', 'realizado_2025' => 0],
            ['id' => 11, 'acao' => 'Solicitação de obras e serviços de urbanização',              'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'servicos_online',         'realizado_2025' => 0],
            ['id' => 12, 'acao' => 'Solicitação de serviços de zeladoria',                        'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'servicos_online',         'realizado_2025' => 0],
            ['id' => 13, 'acao' => 'Agendamento de consultas na rede pública de saúde',           'status_2024' => 0, 'status_2025' => 3, 'data_conclusao' => null, 'categoria' => 'servicos_online',         'realizado_2025' => 1],
            ['id' => 14, 'acao' => 'Agendamento de exames em relação a doenças crônicas',         'status_2024' => 0, 'status_2025' => 0, 'data_conclusao' => null, 'categoria' => 'servicos_online',         'realizado_2025' => 0],
            ['id' => 15, 'acao' => 'Alvarás / licenças de funcionamento',                         'status_2024' => 0, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'servicos_online',         'realizado_2025' => 1],
            ['id' => 16, 'acao' => 'Cadastro de fornecedores',                                    'status_2024' => 0, 'status_2025' => 3, 'data_conclusao' => null, 'categoria' => 'servicos_online',         'realizado_2025' => 1],
            ['id' => 17, 'acao' => 'Sensores para monitoramento de área de risco',                'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'sistemas_digitais',       'realizado_2025' => 0],
            ['id' => 18, 'acao' => 'Sistema de iluminação inteligente',                           'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'sistemas_digitais',       'realizado_2025' => 0],
            ['id' => 19, 'acao' => 'Ônibus municipal com GPS',                                    'status_2024' => 0, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'sistemas_digitais',       'realizado_2025' => 1],
            ['id' => 20, 'acao' => 'Bilhete eletrônico transporte público',                       'status_2024' => 0, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'sistemas_digitais',       'realizado_2025' => 1],
            ['id' => 21, 'acao' => 'Centro de controle e operações',                              'status_2024' => 0, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'sistemas_digitais',       'realizado_2025' => 1],
            ['id' => 22, 'acao' => 'Semáforos inteligentes',                                      'status_2024' => 0, 'status_2025' => 0, 'data_conclusao' => null, 'categoria' => 'sistemas_digitais',       'realizado_2025' => 0],
            ['id' => 23, 'acao' => 'Consulta pública',                                            'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'participacao_do_cidadao', 'realizado_2025' => 0],
            ['id' => 24, 'acao' => 'Enquete',                                                     'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'participacao_do_cidadao', 'realizado_2025' => 0],
            ['id' => 25, 'acao' => 'Fóruns ou comunidades',                                       'status_2024' => 0, 'status_2025' => 0, 'data_conclusao' => null, 'categoria' => 'participacao_do_cidadao', 'realizado_2025' => 0],
            ['id' => 26, 'acao' => 'Votação',                                                     'status_2024' => 0, 'status_2025' => 0, 'data_conclusao' => null, 'categoria' => 'participacao_do_cidadao', 'realizado_2025' => 0],
            ['id' => 27, 'acao' => 'Área/Dep. TI',                                                'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'adequacao_municipal',     'realizado_2025' => 0],
            ['id' => 28, 'acao' => 'Ad. Rede GOV.BR',                                             'status_2024' => 0, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'adequacao_municipal',     'realizado_2025' => 1],
            ['id' => 29, 'acao' => 'Assinatura eletrônica',                                       'status_2024' => 0, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'adequacao_municipal',     'realizado_2025' => 1],
            ['id' => 30, 'acao' => 'L.G.D.',                                                      'status_2024' => 0, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'adequacao_municipal',     'realizado_2025' => 1],
            ['id' => 31, 'acao' => 'P.A.I.D',                                                     'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'adequacao_municipal',     'realizado_2025' => 0],
            ['id' => 32, 'acao' => 'P.A.I.D - Gov. SP.',                                          'status_2024' => 0, 'status_2025' => 0, 'data_conclusao' => null, 'categoria' => 'adequacao_municipal',     'realizado_2025' => 0],
            ['id' => 33, 'acao' => 'P.A.I.D - Out. Mun.',                                         'status_2024' => 0, 'status_2025' => 0, 'data_conclusao' => null, 'categoria' => 'adequacao_municipal',     'realizado_2025' => 0],
            ['id' => 34, 'acao' => 'PDTI',                                                        'status_2024' => 0, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'adequacao_municipal',     'realizado_2025' => 1],
            ['id' => 35, 'acao' => 'Processo Administrativo Digital',                             'status_2024' => 0, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'adequacao_municipal',     'realizado_2025' => 1],
            ['id' => 36, 'acao' => 'Serviços Online',                                             'status_2024' => 1, 'status_2025' => 1, 'data_conclusao' => null, 'categoria' => 'adequacao_municipal',     'realizado_2025' => 0],
        ]);
    }
}
