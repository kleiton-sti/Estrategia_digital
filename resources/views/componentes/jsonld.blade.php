{{--
    Componente: jsonld
    Emite um <script type="application/ld+json"> no @stack('jsonld') do layout.

    Parâmetros obrigatórios:
      $tipo — string: 'home' | 'artigo' | 'listaArtigos' | 'roadmap'
                    | 'regulamentacoes' | 'plano' | 'tabelas' | 'produtos'

    Parâmetros opcionais (dependem do tipo):
      $artigo          — Model Artigo      (tipo: artigo)
      $eixos           — Collection Eixo   (tipo: home, roadmap)
      $artigos         — Collection Artigo (tipo: listaArtigos)
      $regulamentacoes — Collection        (tipo: regulamentacoes)
      $subtipo         — string            (tipo: produtos — ex.: 'All Hands', 'STII em Números')
      $totalIniciativas, $concluidas, $andamento, $naoIniciadas — ints (tipo: home)
--}}

@push('jsonld')
@php
    $baseUrl   = rtrim(config('app.url', 'https://estrategiadigital.caraguatatuba.sp.gov.br'), '/');
    $orgId     = $baseUrl . '/#organization';
    $websiteId = $baseUrl . '/#website';
    $logoUrl   = 'https://www.caraguatatuba.sp.gov.br/pmc/wp-content/themes/awesomepmc/assets/img/favicon.png';

    /* ── Bloco Organization (sempre presente) ── */
    $organization = [
        '@type'         => 'GovernmentOrganization',
        '@id'           => $orgId,
        'name'          => 'Secretaria de Tecnologia da Informação e Inovação — Prefeitura de Caraguatatuba',
        'alternateName' => 'STII Caraguatatuba',
        'url'           => $baseUrl,
        'logo'          => ['@type' => 'ImageObject', 'url' => $logoUrl],
        'address'       => [
            '@type'           => 'PostalAddress',
            'addressLocality' => 'Caraguatatuba',
            'addressRegion'   => 'SP',
            'addressCountry'  => 'BR',
        ],
        'telephone'          => '+551238978100',
        'sameAs'             => [
            'https://www.caraguatatuba.sp.gov.br/pmc/',
            'https://www.facebook.com/prefeituradecaraguatatuba',
            'https://www.instagram.com/caraguatatuba_oficial/',
        ],
        'parentOrganization' => [
            '@type' => 'GovernmentOrganization',
            'name'  => 'Prefeitura Municipal de Caraguatatuba',
            'url'   => 'https://www.caraguatatuba.sp.gov.br/pmc/',
        ],
    ];

    /* ── Bloco WebSite (sempre presente) ── */
    $website = [
        '@type'           => 'WebSite',
        '@id'             => $websiteId,
        'url'             => $baseUrl,
        'name'            => 'Estratégia Digital — Caraguatatuba',
        'description'     => 'Portal de Estratégia Digital da Secretaria de Tecnologia da Informação e Inovação da Prefeitura de Caraguatatuba.',
        'publisher'       => ['@id' => $orgId],
        'inLanguage'      => 'pt-BR',
    ];

    $graphs = [$organization, $website];

    /* ════════════════════════════════════════════
       HOME
    ════════════════════════════════════════════ */
    if ($tipo === 'home') {
        $graphs[] = [
            '@type'       => 'WebPage',
            '@id'         => $baseUrl . '/#webpage',
            'url'         => $baseUrl . '/',
            'name'        => 'Estratégia Digital — Caraguatatuba',
            'description' => 'Acompanhe as estratégias, objetivos e iniciativas da Secretaria de Tecnologia da Informação e Inovação para a transformação digital da Prefeitura de Caraguatatuba.',
            'isPartOf'    => ['@id' => $websiteId],
            'about'       => ['@id' => $orgId],
            'inLanguage'  => 'pt-BR',
            'breadcrumb'  => [
                '@type'           => 'BreadcrumbList',
                'itemListElement' => [[
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => 'Home',
                    'item'     => $baseUrl . '/',
                ]],
            ],
            'hasPart' => $eixos->map(fn($e) => [  //cada eixo passa a ser um elemento semântico da página
                '@type'       => 'WebPageElement',
                'name'        => $e->titulo,
                'description' => $e->descricao,
                'cssSelector' => '#eixo-' . $e->slug,
            ])->values()->all(),

            'keywords' => $eixos->pluck('titulo')->implode(', '),
        ];

        if (!empty($eixos) && $eixos->isNotEmpty()) {
            $graphs[] = [
                '@type'           => 'ItemList',
                'name'            => 'Eixos Estratégicos da Transformação Digital',
                'description'     => 'Os 6 eixos que estruturam o Plano de Transformação Digital de Caraguatatuba.',
                'numberOfItems'   => $eixos->count(),
                'itemListElement' => $eixos->map(fn($e, $i) => [
                    '@type'    => 'ListItem',
                    'position' => $i + 1,
                    'name'     => $e->titulo,
                    'description' => $e->descricao,
                    'url'      => $baseUrl . '/#eixo-' . $e->slug,
                ])->values()->all(),
            ];
        }

        if (isset($totalIniciativas)) {
            $graphs[] = [
                '@type'            => 'Dataset',
                'name'             => 'Indicadores da Estratégia Digital — Caraguatatuba',
                'description'      => "Painel de acompanhamento das {$totalIniciativas} iniciativas de transformação digital.",
                'publisher'        => ['@id' => $orgId],
                'variableMeasured' => [
                    ['@type' => 'PropertyValue', 'name' => 'Total de Iniciativas',      'value' => $totalIniciativas],
                    ['@type' => 'PropertyValue', 'name' => 'Iniciativas Concluídas',    'value' => $concluidas   ?? 0],
                    ['@type' => 'PropertyValue', 'name' => 'Iniciativas Em Execução',   'value' => $andamento    ?? 0],
                    ['@type' => 'PropertyValue', 'name' => 'Iniciativas Não Iniciadas', 'value' => $naoIniciadas ?? 0],
                ],
            ];
        }
    }

    /* ════════════════════════════════════════════
       ARTIGO (página de conteúdo individual)
    ════════════════════════════════════════════ */
    elseif ($tipo === 'artigo' && isset($artigo)) {
        $artigoUrl = $baseUrl . '/artigos/' . $artigo->slug;

        $graphs[] = [
            '@type'            => 'Article',
            '@id'              => $artigoUrl . '#article',
            'headline'         => $artigo->titulo,
            'description'      => $artigo->subtitulo,
            'articleBody'      => $artigo->corpo,
            'url'              => $artigoUrl,
            'datePublished'    => $artigo->created_at->toIso8601String(),
            'dateModified'     => ($artigo->updated_at ?? $artigo->created_at)->toIso8601String(),
            'inLanguage'       => 'pt-BR',
            'isPartOf'         => ['@id' => $websiteId],
            'publisher'        => ['@id' => $orgId],
            'author'           => ['@type' => 'Person', 'name' => $artigo->user->nome ?? 'Equipe STII'],
            'articleSection'   => $artigo->categorias->pluck('nome')->implode(', ') ?? 'Governo Digital',
            'keywords'         => $artigo->categorias->pluck('nome')->implode(', '),
            'mainEntityOfPage' => ['@id' => $artigoUrl . '#webpage'],
            'about'            => ['@id' => $orgId],
        ];

        $graphs[] = [
            '@type'      => 'WebPage',
            '@id'        => $artigoUrl . '#webpage',
            'url'        => $artigoUrl,
            'name'       => $artigo->titulo,
            'isPartOf'   => ['@id' => $websiteId],
            'inLanguage' => 'pt-BR',
            'breadcrumb' => [
                '@type'           => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',           'item' => $baseUrl . '/'],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Artigos',        'item' => $baseUrl . '/artigos'],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $artigo->titulo,  'item' => $artigoUrl],
                ],
            ],
        ];
    }

    /* ════════════════════════════════════════════
       LISTA DE ARTIGOS
    ════════════════════════════════════════════ */
    elseif ($tipo === 'listaArtigos') {
        $graphs[] = [
            '@type'       => 'CollectionPage',
            '@id'         => $baseUrl . '/artigos#webpage',
            'url'         => $baseUrl . '/artigos',
            'name'        => 'Artigos — Estratégia Digital',
            'description' => 'Explore conteúdos sobre transformação digital, inovação e gestão pública de Caraguatatuba.',
            'isPartOf'    => ['@id' => $websiteId],
            'publisher'   => ['@id' => $orgId],
            'inLanguage'  => 'pt-BR',
            'breadcrumb'  => [
                '@type'           => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',    'item' => $baseUrl . '/'],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Artigos', 'item' => $baseUrl . '/artigos'],
                ],
            ],
        ];

        if (!empty($artigos) && $artigos->isNotEmpty()) {
            $graphs[] = [
                '@type'           => 'ItemList',
                'name'            => 'Artigos sobre Transformação Digital',
                'itemListElement' => $artigos->map(fn($a, $i) => [
                    '@type'    => 'ListItem',
                    'position' => $i + 1,
                    'url'      => $baseUrl . '/artigos/' . $a->slug . '/' . $a->id,
                    'name'     => $a->titulo,
                ])->values()->all(),
            ];
        }
    }

    /* ════════════════════════════════════════════
       ROADMAP
    ════════════════════════════════════════════ */
    elseif ($tipo === 'roadmap') {
        $graphs[] = [
            '@type'       => 'WebPage',
            '@id'         => $baseUrl . '/roadmap#webpage',
            'url'         => $baseUrl . '/roadmap',
            'name'        => 'Roadmap — Estratégia Digital Caraguatatuba',
            'description' => 'Roteiro que orienta a Prefeitura de Caraguatatuba rumo a um governo 100% digital, transparente e conectado.',
            'isPartOf'    => ['@id' => $websiteId],
            'publisher'   => ['@id' => $orgId],
            'inLanguage'  => 'pt-BR',
            'breadcrumb'  => [
                '@type'           => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',    'item' => $baseUrl . '/'],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Roadmap', 'item' => $baseUrl . '/roadmap'],
                ],
            ],
        ];

        if (!empty($eixos) && $eixos->isNotEmpty()) {
            $graphs[] = [
                '@type'           => 'ItemList',
                'name'            => 'Roadmap de Transformação Digital por Eixo',
                'itemListElement' => $eixos->map(fn($e, $i) => [
                    '@type'       => 'ListItem',
                    'position'    => $i + 1,
                    'name'        => $e->titulo,
                    'description' => $e->roadmaps
                        ->where('status', 'entregue_recentemente')
                        ->pluck('acao')
                        ->take(3)
                        ->implode('; '),
                ])->values()->all(),
            ];
        }
    }

    /* ════════════════════════════════════════════
       REGULAMENTAÇÕES
    ════════════════════════════════════════════ */
    elseif ($tipo === 'regulamentacoes') {
        $graphs[] = [
            '@type'       => 'WebPage',
            '@id'         => $baseUrl . '/regulamentacoes#webpage',
            'url'         => $baseUrl . '/regulamentacoes',
            'name'        => 'Regulamentações — Estratégia Digital Caraguatatuba',
            'description' => 'Principais políticas, regulamentações e publicações da Secretaria de Tecnologia de Caraguatatuba.',
            'isPartOf'    => ['@id' => $websiteId],
            'publisher'   => ['@id' => $orgId],
            'inLanguage'  => 'pt-BR',
            'breadcrumb'  => [
                '@type'           => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',            'item' => $baseUrl . '/'],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Regulamentações', 'item' => $baseUrl . '/regulamentacoes'],
                ],
            ],
        ];

        if (!empty($regulamentacoes)) {
            foreach ($regulamentacoes as $reg) {
                if (empty($reg->titulo)) continue;
                $graphs[] = array_filter([
                    '@type'         => 'GovernmentService',
                    'name'          => $reg->titulo,
                    'description'   => $reg->descricao ?? '',
                    'url'           => $reg->link      ?? '',
                    'provider'      => ['@id' => $orgId],
                    'datePublished' => $reg->publicado_em
                        ? \Carbon\Carbon::parse($reg->publicado_em)->toIso8601String()
                        : null,
                ]);
            }
        }
    }

    /* ════════════════════════════════════════════
       PLANO DIRETOR (PDTI)
    ════════════════════════════════════════════ */
    elseif ($tipo === 'plano') {
        $graphs[] = [
            '@type'       => 'WebPage',
            '@id'         => $baseUrl . '/plano-diretor-ti#webpage',
            'url'         => $baseUrl . '/plano-diretor-ti',
            'name'        => 'PDTI — Plano Diretor de Tecnologia da Informação',
            'description' => 'Plano Diretor de Tecnologia da Informação e Inovação da Prefeitura de Caraguatatuba.',
            'isPartOf'    => ['@id' => $websiteId],
            'publisher'   => ['@id' => $orgId],
            'inLanguage'  => 'pt-BR',
            'breadcrumb'  => [
                '@type'           => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $baseUrl . '/'],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'PDTI', 'item' => $baseUrl . '/plano-diretor-ti'],
                ],
            ],
        ];

        $graphs[] = [
            '@type'        => 'GovernmentService',
            'name'         => 'Plano Diretor de Tecnologia da Informação e Inovação',
            'alternateName'=> 'PDTI',
            'provider'     => ['@id' => $orgId],
            'url'          => $baseUrl . '/plano-diretor-ti',
            'description'  => 'Documento que orienta as ações estratégicas de TI e inovação da Prefeitura de Caraguatatuba.',
            'serviceType'  => 'Planejamento de TI',
            'areaServed'   => [
                '@type'            => 'City',
                'name'             => 'Caraguatatuba',
                'containedInPlace' => ['@type' => 'State', 'name' => 'São Paulo'],
            ],
        ];
    }

    /* ════════════════════════════════════════════
       TABELAS / INDICADORES
    ════════════════════════════════════════════ */
    elseif ($tipo === 'tabelas') {
        $graphs[] = [
            '@type'       => 'WebPage',
            '@id'         => $baseUrl . '/indicadores#webpage',
            'url'         => $baseUrl . '/indicadores',
            'name'        => 'Indicadores — Estratégia Digital Caraguatatuba',
            'description' => 'Acompanhe os indicadores de transformação digital da Prefeitura de Caraguatatuba.',
            'isPartOf'    => ['@id' => $websiteId],
            'publisher'   => ['@id' => $orgId],
            'inLanguage'  => 'pt-BR',
            'breadcrumb'  => [
                '@type'           => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',        'item' => $baseUrl . '/'],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Indicadores', 'item' => $baseUrl . '/indicadores'],
                ],
            ],
        ];

        $graphs[] = [
            '@type'       => 'Dataset',
            'name'        => 'Indicadores de Ações de Inovação — Caraguatatuba',
            'description' => 'Tabela de acompanhamento das ações de inovação e transformação digital da Prefeitura de Caraguatatuba.',
            'publisher'   => ['@id' => $orgId],
            'url'         => $baseUrl . '/indicadores',
            'temporalCoverage' => "2025/2026",
            'keywords' => [
                'Inovação',
                'Transformação Digital',
                'Caraguatatuba',
            ],
            'license'     => 'https://creativecommons.org/licenses/by/4.0/',
            'creator'     => ['@id' => $orgId],
        ];
    }

    /* ════════════════════════════════════════════
       PRODUTOS (STII em Números / All Hands)
    ════════════════════════════════════════════ */
    elseif ($tipo === 'produtos') {
        $nomePagina = $subtipo ?? 'Produtos';
        $slugPagina = ($subtipo === 'All Hands') ? 'all-hands' : 'stii-em-numeros';
        $urlPagina  = $baseUrl . '/produtos/' . $slugPagina;

        $graphs[] = [
            '@type'       => 'WebPage',
            '@id'         => $urlPagina . '#webpage',
            'url'         => $urlPagina,
            'name'        => $nomePagina . ' — Estratégia Digital Caraguatatuba',
            'description' => 'Resultados e entregas da ' . $nomePagina . ' da Secretaria de Tecnologia da Informação e Inovação.',
            'isPartOf'    => ['@id' => $websiteId],
            'publisher'   => ['@id' => $orgId],
            'inLanguage'  => 'pt-BR',
            'breadcrumb'  => [
                '@type'           => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',      'item' => $baseUrl . '/'],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => $nomePagina, 'item' => $urlPagina],
                ],
            ],
        ];
    }

    $jsonld = json_encode(
        ['@context' => 'https://schema.org', '@graph' => $graphs],
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
    );
@endphp
<script type="application/ld+json">
{!! $jsonld !!}
</script>
@endpush
