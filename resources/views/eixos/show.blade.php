@extends('layouts.app')

@section('content')
<main id="main-content" class="main principios-details-page pagina-interna">

  <!-- Objetivos -->
  <section id="objetivos" class="objetivos section">
    <div class="container section-title-obj" data-aos="fade-up">
      <div class="section-title-obj-texto">
        <h1>{{ $eixo->titulo }}</h1>
        <p>{{ $eixo->descricao }}</p>
      </div>
      <!-- constelação neural de progresso -->
      <div class="constelacao-wrap">
        <div id="contelacao-absolute">
          @include('componentes.constelacao', [
            'constelacao' => $constelacao,
            'progresso'   => $progresso,
            'eixoId'      => $eixo->id_eixos,
          ])
        </div>
        <div class="constelacao-pct-wrap">
          <span class="constelacao-pct">{{ round($progresso * 100) }}%</span>
          <span class="constelacao-pct-desc"> concluído</span>
        </div>
      </div>
    </div>

    <div class="container" data-aos="fade-up">
      <h2>Objetivos</h2>
      <div class="row gy-4 isotope-container">
        @foreach($eixo->objetivos as $objetivo)
          <div class="col-xl-4 col-lg-6 objetivos-item" data-objetivo-id="{{ $objetivo->id_objetivo }}">
            <div class="objetivos-wrapper">
              <div class="objetivos-content d-flex align-items-center justify-content-between">
                <div>
                  <h3 class="objetivo-titulo mb-2">{{ $objetivo->titulo }}</h3>
                  <span class="badge color-azul"><strong>{{ $objetivo->iniciativas->count() }}</strong> Iniciativas</span>
                </div>
                <i class="bi bi-chevron-down objetivo-toggle" aria-hidden="true"></i>
              </div>
              <div class="objetivo-iniciativas is-hidden mt-iniciativas" aria-live="polite"></div>
            </div>
          </div>
        @endforeach
      </div>
      {{-- Bug corrigido: linha abaixo estava fora do @foreach e exibia apenas a descrição do último objetivo --}}

    </div>
  </section>

  <!-- Iniciativas -->
  <section id="principios-details" class="principios-details section is-hidden">
    <div class="container" data-aos="fade-up">

      <!-- Painel de resumo estilo dashboard -->
      <div class="ini-painel">

        <!-- Bloco principal: total + titulo -->
        <div class="ini-painel-destaque">
          <span class="ini-painel-numero" id="sidebar-total">{{ $sidebar['total'] }}</span>
          <div class="ini-painel-destaque-texto">
            <span class="ini-painel-label">Iniciativas</span>
            <span class="ini-painel-sublabel">do objetivo selecionado</span>
          </div>
        </div>

        <div class="ini-painel-divisor"></div>

        <!-- Anel de concluídas -->
        <div class="ini-painel-anel-wrap">
          <svg class="ini-anel-svg" viewBox="0 0 64 64">
            <circle class="ini-anel-trilha" cx="32" cy="32" r="26"/>
            <circle class="ini-anel-progresso" cx="32" cy="32" r="26" id="ini-anel-circulo"/>
          </svg>
          <span class="ini-anel-numero" id="sidebar-concluidas">{{ $sidebar['concluidas'] }}</span>
        </div>
        <div class="ini-painel-anel-info">
          <span class="ini-painel-badge ini-badge-concluida">Concluídas</span>
          <span class="ini-painel-sublabel" id="ini-legenda-concluidas">de {{ $sidebar['total'] }} iniciativas entregues</span>
        </div>

        <div class="ini-painel-divisor"></div>

        <!-- Em execução -->
        <div class="ini-painel-contador">
          <span class="ini-contador-numero ini-cor-amarelo" id="sidebar-andamento">{{ $sidebar['andamento'] }}</span>
          <span class="ini-painel-badge ini-badge-andamento">Em Execução</span>
        </div>

        <div class="ini-painel-divisor"></div>

        <!-- Não iniciadas -->
        <div class="ini-painel-contador">
          <span class="ini-contador-numero ini-cor-vermelho" id="sidebar-nao">{{ $sidebar['nao'] }}</span>
          <span class="ini-painel-badge ini-badge-nao">Não Iniciadas</span>
        </div>

      </div>

      <!-- Lista de iniciativas -->
      <div class="iniciativas mt-4">
        <div class="principios-content">
          <div class="principios-process">
            <div class="process-steps"></div>
          </div>
        </div>
      </div>

    </div>
  </section>

</main>
@endsection

@push('scripts')
<script>
  window.objetivosData = @json($objetivosData);
</script>
<script src="{{ asset('assets/js/charge.js') }}"></script>
@endpush
