<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Erro 500 — Estratégia Digital</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

  <!-- CSS -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/menu.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/error.css') }}" rel="stylesheet">
</head>

<body class="erro-page">

  <div class="hero-bg-elements">
    <div class="bg-particles"></div>
  </div>

  <header id="header" class="header d-flex align-items-center" aria-label="Cabeçalho">
    <div class="header-container container-fluid d-flex align-items-center justify-content-center">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center">
        <img src="https://www.caraguatatuba.sp.gov.br/pmc/wp-content/themes/awesomepmc/assets/img/favicon.png" alt="">
        <span class="sitename">Secretaria de Tecnologia</span>
      </a>
    </div>
  </header>

  <main class="erro-wrap">
    <div class="erro-glow-a" aria-hidden="true"></div>

    <div class="erro-content">
      <span class="erro-badge">
        <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
        Erro interno
      </span>

      <div class="erro-codigo-wrap">
        <span class="erro-codigo">500</span>
      </div>

      <h1 class="erro-titulo">Algo deu errado do nosso lado</h1>
      <p class="erro-desc">
        Encontramos um problema inesperado ao processar sua solicitação. Nossa equipe já foi
        notificada e está trabalhando para normalizar o serviço. Tente novamente em alguns instantes.
      </p>

      <div class="erro-acoes">
        <a href="{{ url('/') }}" class="erro-btn erro-btn--primario">
          <i class="bi bi-house-door-fill" aria-hidden="true"></i>
          Voltar para o início
        </a>
        <a href="javascript:location.reload()" class="erro-btn erro-btn--secundario">
          <i class="bi bi-arrow-clockwise" aria-hidden="true"></i>
          Tentar novamente
        </a>
      </div>

      @if(isset($exception) && config('app.debug'))
        <span class="erro-codigo-tecnico">{{ get_class($exception) }}: {{ $exception->getMessage() }}</span>
      @endif
    </div>
  </main>

  <footer class="erro-footer" role="contentinfo">
    <p class="mb-0">© {{ date('Y') }} Prefeitura Municipal de Caraguatatuba — Secretaria de Tecnologia da Informação e Inovação</p>
  </footer>

  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
