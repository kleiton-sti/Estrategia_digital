@php
    $baseUrl = config('app.url');
    $imgPadrao = $baseUrl . '/assets/img/estrategia-digital.png';

    if ($tipo === 'artigo' && isset($artigo)) {
        $titulo = Str::limit($artigo->titulo . ' — Estratégia Digital', 60);
        $descricao = $artigo->subtitulo ?? 'Leia mais sobre inovação em Caraguatatuba.';
        $url = $baseUrl . '/artigos/' . $artigo->slug;
        $autor = $artigo->user?->nome ?? 'Equipe STII';
        $imagem =  $imgPadrao;
        $ogType = 'article';
    } else {
        // Configuração para app.layout
        $titulo = 'Estratégia Digital — Prefeitura de Caraguatatuba';
        $descricao = 'Portal de acompanhamento dos eixos estratégicos e iniciativas de transformação digital.';
        $url = $baseUrl;
        $imagem = $imgPadrao;
        $ogType = 'website';
    }
@endphp

@push('og_meta')
    <!-- Open Graph / Facebook / WhatsApp -->
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:url" content="{{ $url }}">
    <meta property="og:title" content="{{ $titulo }}">
    <meta property="og:description" content="{{ $descricao }}">
    <meta property="og:image" content="{{ $imagem }}">
    <meta property="og:image:width" content="1201">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Estratégia Digital Caraguatatuba">
    <meta property="og:locale" content="pt_BR">
    <meta name="author" content="">

    <!-- Twitter / X -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $titulo }}">
    <meta name="twitter:description" content="{{ $descricao }}">
    <meta name="twitter:image" content="{{ $imagem }}">
@endpush