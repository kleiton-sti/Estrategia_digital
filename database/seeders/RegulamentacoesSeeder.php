<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegulamentacoesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('regulamentacoes')->insert([
            ['id' => 1, 'titulo' => 'Decreto nº 2.283, de 24 de julho de 2025',        'descricao' => 'Aplica a Lei Federal nº 14.129/2021 no âmbito da Administração Pública de Caraguatatuba.',                    'link' => 'https://caraguatatuba.legislacaocompilada.com.br/Arquivo/Documents/legislacao/html/D22832025.html', 'publicado_em' => '2025-08-05', 'pendente' => 1],
            ['id' => 2, 'titulo' => 'Decreto nº 2.333, de 11 de setembro de 2025',     'descricao' => 'Cria grupo de trabalho para adequação da Administração à Lei Geral de Proteção de Dados (LGPD).',             'link' => 'https://caraguatatuba.legislacaocompilada.com.br/Arquivo/Documents/legislacao/html/D23332025.html', 'publicado_em' => '2025-09-19', 'pendente' => 1],
            ['id' => 3, 'titulo' => 'Decreto nº 2.353, de 08 de outubro de 2025',      'descricao' => 'Altera o decreto do grupo de trabalho sobre adequação da Administração à Lei Geral de Proteção de Dados.',    'link' => 'https://caraguatatuba.legislacaocompilada.com.br/Arquivo/Documents/legislacao/html/D23532025.html', 'publicado_em' => '2025-10-10', 'pendente' => 1],
            ['id' => 4, 'titulo' => 'Decreto nº 2.363, de 14 de outubro de 2025',      'descricao' => 'Nomeia o DPO titular e suplente',                                                                               'link' => 'https://caraguatatuba.legislacaocompilada.com.br/Arquivo/Documents/legislacao/html/D23632025.html', 'publicado_em' => '2025-10-21', 'pendente' => 0],
            ['id' => 5, 'titulo' => 'Decreto 2.394, de 25 de Novembro de 2025',        'descricao' => 'Regula a utilização de processos eletrônicos no município',                                                    'link' => 'https://caraguatatuba.legislacaocompilada.com.br/Arquivo/Documents/legislacao/html/d23942025.html', 'publicado_em' => '2025-12-03', 'pendente' => 0],
            ['id' => 6, 'titulo' => 'Decreto 2.368, de 22 de Outubro de 2025',         'descricao' => 'Instituição da Política Municipal de Dados Abertos',                                                           'link' => 'https://caraguatatuba.legislacaocompilada.com.br/Arquivo/Documents/legislacao/html/D23682025.html', 'publicado_em' => '2025-12-08', 'pendente' => 0],
            ['id' => 7, 'titulo' => 'Decreto 2.396, de 01 de Dezembro de 2025',        'descricao' => 'Instituição do Plano Diretor de Tecnologia da Informação do Município de Caraguatatuba',                      'link' => 'https://caraguatatuba.legislacaocompilada.com.br/Arquivo/Documents/legislacao/html/d23962025.html', 'publicado_em' => '2025-12-03', 'pendente' => 0],
        ]);
    }
}
