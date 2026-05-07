<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Estratégia Digital')</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

  <!-- CSS -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/hero.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/menu.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/objetivos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/principios.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/roadmap.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/tabelas.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/regulamentacoes.css') }}" rel="stylesheet">
  @stack('styles')
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-5C6J76BMYV"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-5C6J76BMYV');
  </script>
</head>

<body class="@yield('bodyclass','index-page')">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div
      class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
      <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-xl-0">
        <img src="https://www.caraguatatuba.sp.gov.br/pmc/wp-content/themes/awesomepmc/assets/img/favicon.png" alt="">
        <h1 class="sitename">Secretaria de Tecnologia</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href={{ route('home') }}>Home</a></li>

          <li class="dropdown">
            <a href="#">
              <span>Eixos</span> <i class="bi bi-chevron-down"></i>
            </a>
            <ul>
              @foreach($todosEixos as $ex)
              <li class="@if(isset($eixo) && $ex->id_eixos == $eixo->id_eixos) active @endif">
                <a href="{{ route('eixos.show', $ex->id_eixos) }}">
                  <span>{{ $ex->titulo }}</span>
                </a>
              </li>
              @endforeach
            </ul>
          </li>

          <li class="dropdown">
            <a href="#">
              <span>Indicadores</span> <i class="bi bi-chevron-down"></i>
            </a>
            <ul>
              <li><a href="{{ route('tabelas') }}"><span>Painel TCESP</span></a></li>
              <!-- <li><a href="#"><span>IEGM</span></a></li> -->
            </ul>
          </li>

          <li class="dropdown">
            <a href="#">
              <span>Políticas</span> <i class="bi bi-chevron-down"></i>
            </a>
            <ul>
              <li><a href="{{ route('regulamentacoes') }}"><span>Regulamentação</span></a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="#">
              <span>Produtos</span> <i class="bi bi-chevron-down"></i>
            </a>
            <ul>
              <li><a href="{{ route('produtos.all.hands') }}"><span>All Hands</span></a></li>
              <li><a href="{{ route('produtos.stii.numeros') }}"><span>STII em números</span></a></li>
            </ul>
          </li>

          <li><a href="{{ route('plano') }}">PDTI</a></li>

          <li><a href="{{ route('roadmap') }}">Roadmap</a></li>

        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  @yield('content')

  <footer id="footer" class="text-white">

    <!-- Footer logo -->
    <div class="text-white text-center footer-back py-2">
      <a href="https://www.caraguatatuba.sp.gov.br/pmc/" title="Prefeitura Municipal de Caraguatatuba">
        <img class="img-fluid footer-logo mx-auto"
          src="https://www.caraguatatuba.sp.gov.br/pmc/wp-content/themes/awesomepmc/assets/img/logo-branco.png"
          alt="Prefeitura Municipal de Caraguatatuba">
      </a>
    </div>

    <div class="container py-5">

      <!-- Links em colunas -->
      <div class="row">

        <div class="col-6 col-md-2 mb-4">
          <h6 class="fw-bold">PRINCIPAIS SERVIÇOS</h6>
          <ul class="list-unstyled small">
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/agenda-do-prefeito" class="text-white text-decoration-none">Agenda do Prefeito</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/category/diario-oficial/" class="text-white text-decoration-none">Diário Oficial</a></li>
            <li><a href="https://fundacc.sp.gov.br/" class="text-white text-decoration-none">Fundacc</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/" class="text-white text-decoration-none">Notícias</a></li>
            <li><a href="https://portaldatransparencia.caraguatatuba.sp.gov.br/home" class="text-white text-decoration-none">Transparência</a></li>
            <li><a href="https://www.caragua.tur.br/" class="text-white text-decoration-none">Turismo</a></li>
          </ul>
        </div>

        <div class="col-6 col-md-2 mb-4">
          <h6 class="fw-bold">CIDADÃO</h6>
          <ul class="list-unstyled small">
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/concursos-e-processos-seletivos/" class="text-white text-decoration-none">Concursos e Processos</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/conselhos/" class="text-white text-decoration-none">Conselhos</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/minha-casa-minha-vida/" class="text-white text-decoration-none">Habitação</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/meio-ambiente/" class="text-white text-decoration-none">Meio Ambiente</a></li>
            <li><a href="https://pmcaraguatatuba.geosiap.net.br/pmcaraguatatuba/websis/siapegov/administrativo/gpro/gpro_index.php" class="text-white text-decoration-none">Portal do Cidadão</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/saude/" class="text-white text-decoration-none">Saúde</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/social/" class="text-white text-decoration-none">Social</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/trabalho/" class="text-white text-decoration-none">Trabalho</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/consultas/" class="text-white text-decoration-none">Tributos</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-ao-cidadao/transito/" class="text-white text-decoration-none">Trânsito</a></li>
          </ul>
        </div>

        <div class="col-6 col-md-2 mb-4">
          <h6 class="fw-bold">EMPRESA</h6>
          <ul class="list-unstyled small">
            <li><a href="https://www.comprascaragua.com.br/home.jsf?windowId=490" class="text-white text-decoration-none">Portal de Compras</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-a-empresa/baixa-de-inscricao/" class="text-white text-decoration-none">Baixa de Inscrição</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-a-empresa/sistema-de-emissao-de-notas-fiscais-eletronicas/" class="text-white text-decoration-none">ISS/NFE/ICMS</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/clube-do-servidor/" class="text-white text-decoration-none">Clube do Servidor</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-a-empresa/licenciamento-ambiental/" class="text-white text-decoration-none">Licenciamento Ambiental</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-a-empresa/licitacoes/" class="text-white text-decoration-none">Licitações</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-a-empresa/mineracao/" class="text-white text-decoration-none">Mineração</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-a-empresa/plano-diretor/" class="text-white text-decoration-none">Plano Diretor</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servicos-a-empresa/plano-diretor-de-turismo/" class="text-white text-decoration-none">Plano Diretor de Turismo</a></li>
          </ul>
        </div>

        <!-- <div class="col-6 col-md-2 mb-4">
          <h6 class="fw-bold">SERVIDOR</h6>
          <ul class="list-unstyled small">
            <li><a href="https://www.caraguaprev.sp.gov.br/" class="text-white text-decoration-none">CaraguaPrev</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/clube-do-servidor/" class="text-white text-decoration-none">Clube do Servidor</a></li>
            <li><a href="https://caraguatatuba.geosiap.net.br/pmcaraguatatuba/websis/siapegov/login.php?redirect=//caraguatatuba.geosiap.net.br/pmcaraguatatuba/websis/siapegov/administrativo/processos/processos_index.php?" class="text-white text-decoration-none">Sistema de Protocolo</a></li>
            <li><a href="https://caraguatatuba.legislacaocompilada.com.br/legislacao/norma.aspx?id=3341&termo=Lei+Complementar+25%2f2007#" class="text-white text-decoration-none">Lei Complementar 25/2007 (Estatuto do Servidor)</a></li>
            <li><a href="https://siggeo.caraguatatuba.sp.gov.br/" class="text-white text-decoration-none">Sistema Municipal para Gestão da Geoinformação – SIGGEO</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/departamento-de-recursos-humanos/" class="text-white text-decoration-none">Departamento de Recursos Humanos</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/departamento-etico-disciplinar/" class="text-white text-decoration-none">Departamento Ético Disciplinar</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/departamento-de-medicina-e-seguranca-do-trabalho-dmst/" class="text-white text-decoration-none">Departamento de Medicina e Segurança do Trabalho – DMST</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/servicos/servidor/cipa/" class="text-white text-decoration-none">Comissão Interna de Prevenção de Acidentes – CIPA Documentos</a></li>
          </ul>
        </div> -->

        <div class="col-6 col-md-2 mb-4">
          <h6 class="fw-bold">MAIS</h6>
          <ul class="list-unstyled small">
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/governo-municipal/" class="text-white text-decoration-none">Governo Municipal</a></li>
            <li><a href="https://caraguatatuba.legislacaocompilada.com.br/" class="text-white text-decoration-none">Legislação</a></li>
            <li><a href="https://mail.caraguatatuba.sp.gov.br/" class="text-white text-decoration-none">WebMail</a></li>
            <li><a href="https://www.caraguatatuba.sp.gov.br/pmc/category/clipping/" class="text-white text-decoration-none">Clipping</a></li>
          </ul>
        </div>

        <div class="col-6 col-md-2 mb-4">
          <h6 class="fw-bold">TELEFONES ÚTEIS</h6>
          <ul class="list-unstyled small">
            <li><a href="#" class="text-white  text-decoration-none">Prefeitura: (12) 3897-8100</a></li>
            <li><a href="#" class="text-white text-decoration-none">Ouvidoria/SIC: 0800-770-0678</a></li>
            <li><a href="#" class="text-white text-decoration-none">Ouvidoria Saúde: 0800-779-4545</a></li>
          </ul>
        </div>

      </div>

      <hr>

      <!-- Parte inferior -->
      <div class="text-center mt-4">

        <!-- Links de termos -->
        <!-- <div class="mb-3">
          <a href="#" class="me-3 text-white text-decoration-none small">Termos e Condições</a>
          <a href="#" class="me-3 text-white text-decoration-none small">Política de LGPD</a>
          <a href="#" class="me-3 text-white text-decoration-none small">Política de cookies</a>
          <a href="#" class="me-3 text-white text-decoration-none small">Imprensa</a>
          <a href="https://www.caraguatatuba.sp.gov.br/pmc/fale-conosco/" class="text-white text-decoration-none small">Fale Conosco</a>
        </div> -->

        <!-- Ícones + Copyright + Feito com lado a lado -->
        <div class="d-flex justify-content-center align-items-center footer-gap flex-wrap">

          <!-- Ícones sociais -->
          <div class="d-flex gap-4 align-items-center">
            <a href="https://www.facebook.com/prefeituradecaraguatatuba" class="text-white fs-5"><i
                class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/caraguatatuba_oficial/" class="text-white fs-5"><i
                class="bi bi-instagram"></i></a>
            <a href="https://www.youtube.com/channel/UCH84Ukn-PabhE7vhXxhPUDw" class="text-white fs-5"><i
                class="bi bi-youtube"></i></a>
            <a href="https://www.flickr.com/photos/prefeituracaraguatatuba/albums" class="text-white fs-5"><i
                class="bi bi-image"></i></a>
          </div>

          <!-- Copyright -->
          <p class="small mb-0">
            © Copyright 2025 – Prefeitura Municipal de Caraguatatuba • CNPJ 46.482.840/0001-39
          </p>

          <!-- Feito com -->
          <p class="small footer-p mb-0">
            Feito com <i class="bi bi-heart heart-icon"></i> pela Secretaria de Tecnologia da Informação e Inovação
          </p>

        </div>
      </div>
    </div>
  </footer>

  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  @stack('scripts')
</body>

</html>