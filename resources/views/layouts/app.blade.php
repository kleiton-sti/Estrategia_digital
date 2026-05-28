<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google-site-verification" content="tDWI_BcnYvEE8KNqooTSoGvPaadkx17q8wOe_0nOtRw" />
  @yield('meta')
  @stack('og_meta')

  <title>@yield('title', 'Estratégia Digital')</title>


  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

  <!-- CSS -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/menu.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/hero.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/objetivos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/principios.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/roadmap.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/tabelas.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/regulamentacoes.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/artigos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/conteudo-artigo.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/publicacao.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/constelacao.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/acessibilidade.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
  @stack('styles')

   @stack('jsonld')
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-5C6J76BMYV"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'G-5C6J76BMYV');
  </script>
</head>

<body class="@yield('bodyclass', 'index-page')">

  <div class="hero-bg-elements">
    <div class="bg-particles"></div>
  </div>

  <header id="header" class="header d-flex align-items-center" aria-label="Navegação principal">

    <div
      class="header-container container-fluid container-xl  d-flex align-items-center justify-content-between sticky-top">

      <a href="{{ route('home') }}" class="logo d-flex align-items-center">
        <img src="https://www.caraguatatuba.sp.gov.br/pmc/wp-content/themes/awesomepmc/assets/img/favicon.png" alt="">
        <span class="sitename">Secretaria de Tecnologia</span>
      </a>

      <nav id="navmenu" class="navmenu" aria-label="Menu principal">
        <ul>
          <li><a href="{{ route('home') }}">Home</a></li>

          <li><a href="{{ route('tabelas') }}">Indicadores</a></li>

          <li><a href="{{ route('regulamentacoes') }}">Políticas</a></li>

          <li class="dropdown">
            <a href="#"><span>Produtos</span></a>
            <ul>
              <li><a href="{{ route('produtos.all.hands') }}"><span>All Hands</span></a></li>
              <li><a href="{{ route('produtos.stii.numeros') }}"><span>STII em números</span></a></li>
            </ul>
          </li>

          <li><a href="{{ route('artigos') }}">Artigos</a></li>

          <li><a href="{{ route('plano') }}">PDTI</a></li>

          <li><a href="{{ route('roadmap') }}">Roadmap</a></li>

        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <!-- Acessibilidade -->
  <div id="acessibilidade-widget">
    <div id="painel-acessibilidade">
      <button id="btn-aumentar" title="Aumentar fonte" aria-label="Aumentar tamanho da fonte">
        <span>A+</span>
      </button>
      <button id="btn-diminuir" title="Diminuir fonte" aria-label="Diminuir tamanho da fonte">
        <span>A-</span>
      </button>
      <div class="acess-divisor"></div>
      <button id="btn-contraste" title="Alto contraste" aria-label="Alternar alto contraste" aria-pressed="false">
        <span><i class="bi bi-circle-half" aria-hidden="true"></i></span>
      </button>
    </div>
    <button id="btn-abrir-acessibilidade" title="Acessibilidade" aria-label="Abrir ferramentas de acessibilidade" aria-expanded="false">
      <i class="bi bi-universal-access" aria-hidden="true"></i>
    </button>
  </div>

  @yield('content')

  <footer id="footer" class="text-white" role="contentinfo" aria-label="Rodapé — Prefeitura de Caraguatatuba">

    <div class="text-white text-center footer-back py-2">
      <a href="https://www.caraguatatuba.sp.gov.br/pmc/" title="Prefeitura Municipal de Caraguatatuba">
        <img class="img-fluid footer-logo mx-auto"
          src="https://www.caraguatatuba.sp.gov.br/pmc/wp-content/themes/awesomepmc/assets/img/logo-branco.png"
          alt="Prefeitura Municipal de Caraguatatuba">
      </a>
    </div>

    <div class="container py-5">
      <div class="row justify-content-center">

        <div class="col-6 col-md-2 mb-4">
          <h6 class="fw-bold">PRINCIPAIS SERVIÇOS</h6>
          <ul class="list-unstyled small">
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/agenda-do-prefeito"
                class="text-white text-decoration-none">Agenda do Prefeito</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/category/diario-oficial/"
                class="text-white text-decoration-none">Diário Oficial</a></li>
            <li><a href="https://fundacc.sp.gov.br/" class="text-white text-decoration-none">Fundacc</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/" class="text-white text-decoration-none">Notícias</a>
            </li>
            <li><a href="https://portaldatransparencia.caraguatatuba.sp.gov.br/home"
                class="text-white text-decoration-none">Transparência</a></li>
            <li><a href="https://www.caragua.tur.br/" class="text-white text-decoration-none">Turismo</a></li>
          </ul>
        </div>

        <div class="col-6 col-md-2 mb-4">
          <h6 class="fw-bold">CIDADÃO</h6>
          <ul class="list-unstyled small">
            <li><a
                href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/concursos-e-processos-seletivos/"
                class="text-white text-decoration-none">Concursos e Processos</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/conselhos/"
                class="text-white text-decoration-none">Conselhos</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/minha-casa-minha-vida/"
                class="text-white text-decoration-none">Habitação</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/meio-ambiente/"
                class="text-white text-decoration-none">Meio Ambiente</a></li>
            <li><a
                href="https://pmcaraguatatuba.geosiap.net.br/pmcaraguatatuba/websis/siapegov/administrativo/gpro/gpro_index.php"
                class="text-white text-decoration-none">Portal do Cidadão</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/saude/"
                class="text-white text-decoration-none">Saúde</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/social/"
                class="text-white text-decoration-none">Social</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/trabalho/"
                class="text-white text-decoration-none">Trabalho</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/consultas/"
                class="text-white text-decoration-none">Tributos</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/transito/"
                class="text-white text-decoration-none">Trânsito</a></li>
          </ul>
        </div>

        <div class="col-6 col-md-2 mb-4">
          <h6 class="fw-bold">EMPRESA</h6>
          <ul class="list-unstyled small">
            <li><a href="https://www.comprascaragua.com.br/home.jsf?windowId=490"
                class="text-white text-decoration-none">Portal de Compras</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-a-empresa/baixa-de-inscricao/"
                class="text-white text-decoration-none">Baixa de Inscrição</a></li>
            <li><a
                href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-a-empresa/sistema-de-emissao-de-notas-fiscais-eletronicas/"
                class="text-white text-decoration-none">ISS/NFE/ICMS</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/clube-do-servidor/"
                class="text-white text-decoration-none">Clube do Servidor</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-a-empresa/licitacoes/"
                class="text-white text-decoration-none">Licitações</a></li>
          </ul>
        </div>

        <div class="col-6 col-md-2 mb-4">
          <h6 class="fw-bold">MAIS</h6>
          <ul class="list-unstyled small">
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/governo-municipal/"
                class="text-white text-decoration-none">Governo Municipal</a></li>
            <li><a href="https://caraguatatuba.legislacaocompilada.com.br/"
                class="text-white text-decoration-none">Legislação</a></li>
            <li><a href="https://mail.caraguatatuba.sp.gov.br/" class="text-white text-decoration-none">WebMail</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/category/clipping/"
                class="text-white text-decoration-none">Clipping</a></li>
          </ul>
        </div>

        <div class="col-6 col-md-2 mb-4">
          <h6 class="fw-bold">TELEFONES ÚTEIS</h6>
          <ul class="list-unstyled small">
            <li><a href="#" class="text-white text-decoration-none">Prefeitura: (12) 3897-8100</a></li>
            <li><a href="#" class="text-white text-decoration-none">Ouvidoria/SIC: 0800-770-0678</a></li>
            <li><a href="#" class="text-white text-decoration-none">Ouvidoria Saúde: 0800-779-4545</a></li>
          </ul>
        </div>

      </div>

      <hr>

      <div class="text-center mt-4">
        <div class="d-flex justify-content-center align-items-center footer-gap flex-wrap">
          <div class="d-flex gap-4 align-items-center">
            <a href="https://www.facebook.com/prefeituradecaraguatatuba" class="text-white fs-5" aria-label="Facebook da Prefeitura de Caraguatatuba" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook" aria-hidden="true"></i></a>
            <a href="https://www.instagram.com/caraguatatuba_oficial/" class="text-white fs-5" aria-label="Instagram da Prefeitura de Caraguatatuba" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram" aria-hidden="true"></i></a>
            <a href="https://www.youtube.com/channel/UCH84Ukn-PabhE7vhXxhPUDw" class="text-white fs-5" aria-label="YouTube da Prefeitura de Caraguatatuba" target="_blank" rel="noopener noreferrer"><i class="bi bi-youtube" aria-hidden="true"></i></a>
            <a href="https://www.flickr.com/photos/prefeituracaraguatatuba/albums" class="text-white fs-5" aria-label="Flickr da Prefeitura de Caraguatatuba" target="_blank" rel="noopener noreferrer"><i class="bi bi-image" aria-hidden="true"></i></a>
          </div>
          <p class="small mb-0">© Copyright 2025 – Prefeitura Municipal de Caraguatatuba • CNPJ 46.482.840/0001-39</p>
          <p class="small footer-p mb-0">Feito com <i class="bi bi-heart heart-icon"></i> pela Secretaria de Tecnologia
            da Informação e Inovação</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/acessibilidade.js') }}"></script>
  @stack('scripts')
  <!-- VLibras -->
  <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper vlibras-widget"></div>
    </div>
    
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>new window.VLibras.Widget('https://vlibras.gov.br/app');</script>

</body>

</html>