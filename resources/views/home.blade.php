@extends('layouts.app')

@section('content')
  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="container">
        <div class="row align-items-start">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <div class="hero-content">
              <h1>Estratégia Digital</h1>
              <p>Promovendo a transformação pelo digital e
                garantindo serviços mais simples, transparentes e acessíveis ao cidadão.</p>

              <!-- Cards glassmorphism -->
              <div class="hero-glass-cards">

                <!-- linha superior: Eixos + Objetivos -->
                <div class="glass-cards-row">
                  <div class="glass-card glass-card--eixos" data-aos="fade-up" data-aos-delay="250">
                    <div class="glass-card-numero">6</div>
                    <div class="glass-card-texto">
                      <span class="glass-card-titulo">Eixos</span>
                      <span class="glass-card-desc">Estruturas estratégicas de atuação</span>
                    </div>
                  </div>

                  <div class="glass-card glass-card--objetivos" data-aos="fade-up" data-aos-delay="350">
                    <div class="glass-card-numero">18</div>
                    <div class="glass-card-texto">
                      <span class="glass-card-titulo">Objetivos</span>
                      <span class="glass-card-desc">Metas orientadas à transformação</span>
                    </div>
                  </div>
                </div>

                <!-- card grande de iniciativas -->
                <div class="glass-card glass-card--iniciativas" data-aos="fade-up" data-aos-delay="450">

                  <!-- cabeçalho: total -->
                  <div class="glass-card-texto--iniciativas">
                    <div class="glass-card-numero">81</div>
                    <div class="glass-card-inform">
                      <span class="glass-card-titulo">Iniciativas</span>
                      <span class="glass-card-desc">Ações concretas em andamento</span>
                    </div>
                  </div>

                  <!-- linha de stats -->
                  <div class="iniciativas-stat-row">

                    <!-- concluídas dentro do anel -->
                    <div class="ring-wrap">
                      <svg class="iniciativas-ring" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
                        <circle class="ring-track" cx="60" cy="60" r="52" />
                        <circle class="ring-progress" cx="60" cy="60" r="52" id="ringProgress" />
                      </svg>
                      <div class="ring-inner">
                        <span class="ist-num ist-num--verde purecounter" data-purecounter-start="0"
                          data-purecounter-end="{{ $concluidas }}" data-purecounter-duration="3"></span>
                      </div>
                    </div>

                    <!-- coluna de texto do anel -->
                    <div class="ring-label-col">
                      <span class="ist-pill ist-pill--verde">Concluídas</span>
                      <span class="ist-desc">de 81 iniciativas entregues</span>
                    </div>

                    <!-- divisor -->
                    <div class="stat-divisor"></div>

                    <!-- em execução -->
                    <div class="stat-col">
                      <span class="ist-num ist-num--amarelo purecounter" data-purecounter-start="0"
                        data-purecounter-end="{{ $andamento }}" data-purecounter-duration="3"></span>
                      <span class="ist-pill ist-pill--amarelo">Em execução</span>
                    </div>

                    <!-- não iniciadas -->
                    <div class="stat-col">
                      <span class="ist-num ist-num--vermelho purecounter" data-purecounter-start="0"
                        data-purecounter-end="{{ $naoIniciadas }}" data-purecounter-duration="3"></span>
                      <span class="ist-pill ist-pill--vermelho">Não iniciadas</span>
                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="col-lg-6 colunaImg" data-aos="fade-left" data-aos-delay="200">
            <div class="hero-visual">
              <div class="hero-image">
                <img src="assets/img/misc/misc.png" alt="Digital Agency Hero" class="img-fluid">
                <div id="reflexo-img-1"></div>
                <div id="reflexo-img-2"></div>
                <div id="reflexo-img-3"></div>
                <div id="reflexo-img-4"></div>
                <div id="reflexo-img-5"></div>
                <div id="reflexo-img-6"></div>
                <div id="reflexo-img-7"></div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

      <!-- /Hero Section -->

      <!-- Eixos Section -->
      <section id="principios" class="principios section">
        <div class="container">
          <div class="section-title" data-aos="fade-up">
            <h2>Eixos Estratégicos</h2>
            <p>Cada eixo é uma constelação de iniciativas pensadas para transformar a vida digital do cidadão de Caraguatatuba.</p>
          </div>
          <div class="row gy-4">
            @foreach($eixos as $eixo)
              @php
                $progresso   = $progressoPorEixo[$eixo->id_eixos] ?? 0;
                $constelacao = $constelacoesPorEixo[$eixo->id_eixos] ?? ['nos' => [], 'arestas' => []];
                $totalIni    = $eixo->objetivos->sum(fn($o) => $o->iniciativas->count());
                $cores = [
                  1 => ['glow' => '#04C4D9', 'rgb' => '4,196,217'],
                  2 => ['glow' => '#7c6ef0', 'rgb' => '124,110,240'],
                  3 => ['glow' => '#00db79', 'rgb' => '0,219,121'],
                  4 => ['glow' => '#3b82f6', 'rgb' => '59,130,246'],
                  5 => ['glow' => '#ffd232', 'rgb' => '255,210,50'],
                  6 => ['glow' => '#d946ef', 'rgb' => '217,70,239'],
                ];
                $cor = $cores[$eixo->id_eixos] ?? $cores[1];
              @endphp
              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                <div class="eixo-portal"
                     data-eixo-id="{{ $eixo->id_eixos }}"
                     style="--eixo-glow: {{ $cor['glow'] }}; --eixo-rgb: {{ $cor['rgb'] }}">

                  <!-- Camada de nebulosa de fundo -->
                  <div class="eixo-portal__nebulosa"></div>

                  <!-- Borda superior com glow -->
                  <div class="eixo-portal__fio"></div>

                  <!-- Cabeçalho -->
                  <div class="eixo-portal__header">
                    <span class="eixo-portal__num">0{{ $eixo->id_eixos }}</span>
                    <span class="eixo-portal__badge">{{ $totalIni }} iniciativas</span>
                  </div>

                  <!-- Área da constelação -->
                  <div class="eixo-portal__cst">
                    @include('componentes.constelacao', [
                      'constelacao' => $constelacao,
                      'progresso'   => $progresso,
                      'eixoId'      => $eixo->id_eixos,
                    ])
                    <!-- Estrelas de fundo decorativas -->
                    <div class="eixo-portal__stars" aria-hidden="true"></div>
                  </div>

                  <!-- Rodapé -->
                  <div class="eixo-portal__footer">
                    <h4 class="eixo-portal__titulo">{{ $eixo->titulo }}</h4>
                    <div class="eixo-portal__progresso">
                      <div class="eixo-portal__progresso-barra">
                        <div class="eixo-portal__progresso-fill" style="width: {{ round($progresso * 100) }}%"></div>
                      </div>
                      <span class="eixo-portal__progresso-pct">{{ round($progresso * 100) }}%</span>
                    </div>
                    <span class="eixo-portal__cta">Explorar eixo <i class="bi bi-arrow-right" aria-hidden="true"></i></span>
                  </div>

                </div>
              </div>
            @endforeach
          </div>
        </div>
      </section>
      <!-- /Eixos Section -->

      <!-- Sections de eixo inline (abertas ao clicar no card-portal) -->
      @foreach($eixos as $eixo)
        @php
          $progresso   = $progressoPorEixo[$eixo->id_eixos] ?? 0;
          $constelacao = $constelacoesPorEixo[$eixo->id_eixos] ?? ['nos' => [], 'arestas' => []];
          $objetivosData = $eixo->objetivos->map(fn($o) => [
            'id'          => $o->id_objetivo,
            'titulo'      => $o->titulo,
            'iniciativas' => $o->iniciativas->map(fn($i) => [
              'id'     => $i->id_iniciativa,
              'titulo' => $i->titulo,
              'status' => $i->status,
            ])->toArray(),
          ])->toArray();
          $totalIni    = $eixo->objetivos->sum(fn($o) => $o->iniciativas->count());
          $concluidas  = $eixo->objetivos->sum(fn($o) => $o->iniciativas->where('status', 'Concluída')->count());
          $andamento   = $eixo->objetivos->sum(fn($o) => $o->iniciativas->where('status', 'Em execução')->count());
          $nao         = $eixo->objetivos->sum(fn($o) => $o->iniciativas->where('status', 'Não iniciada')->count());
        @endphp

        <div class="eixo-inline is-hidden" id="eixo-inline-{{ $eixo->id_eixos }}"
             data-objetivos='@json($objetivosData)'>

          <!-- Objetivos -->
          <section class="objetivos section" style="padding-top: 0">
            <div class="container" data-aos="fade-up">
              <div class="section-title-obj">
                <div class="section-title-obj-texto">
                  <h2>{{ $eixo->titulo }}</h2>
                  <p>{{ $eixo->descricao }}</p>
                </div>
                <div class="constelacao-wrap">
                  <div id="constelacao-absolute-{{ $eixo->id_eixos }}">
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

              <h2 class="objetivos-titulo">Objetivos</h2>
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
            </div>
          </section>

          <!-- Iniciativas -->
          <section class="principios-details section is-hidden" id="principios-details-{{ $eixo->id_eixos }}">
            <div class="container" data-aos="fade-up">
              <div class="ini-painel">
                <div class="ini-painel-destaque">
                  <span class="ini-painel-numero" data-sidebar-total>{{ $totalIni }}</span>
                  <div class="ini-painel-destaque-texto">
                    <span class="ini-painel-label">Iniciativas</span>
                    <span class="ini-painel-sublabel">do objetivo selecionado</span>
                  </div>
                </div>
                <div class="ini-painel-divisor"></div>
                <div class="ini-painel-anel-wrap">
                  <svg class="ini-anel-svg" viewBox="0 0 64 64">
                    <circle class="ini-anel-trilha" cx="32" cy="32" r="26"/>
                    <circle class="ini-anel-progresso" cx="32" cy="32" r="26" data-anel-circulo/>
                  </svg>
                  <span class="ini-anel-numero" data-sidebar-concluidas>{{ $concluidas }}</span>
                </div>
                <div class="ini-painel-anel-info">
                  <span class="ini-painel-badge ini-badge-concluida">Concluídas</span>
                  <span class="ini-painel-sublabel" data-legenda-concluidas>de {{ $totalIni }} iniciativas entregues</span>
                </div>
                <div class="ini-painel-divisor"></div>
                <div class="ini-painel-contador">
                  <span class="ini-contador-numero ini-cor-amarelo" data-sidebar-andamento>{{ $andamento }}</span>
                  <span class="ini-painel-badge ini-badge-andamento">Em Execução</span>
                </div>
                <div class="ini-painel-divisor"></div>
                <div class="ini-painel-contador">
                  <span class="ini-contador-numero ini-cor-vermelho" data-sidebar-nao>{{ $nao }}</span>
                  <span class="ini-painel-badge ini-badge-nao">Não Iniciadas</span>
                </div>
              </div>
              <div class="iniciativas mt-4">
                <div class="principios-content">
                  <div class="principios-process">
                    <div class="process-steps"></div>
                  </div>
                </div>
              </div>
              <button class="btn btn-sm btn-outline-secondary mt-3" data-fechar-eixo="{{ $eixo->id_eixos }}">
                <i class="bi bi-x-circle" aria-hidden="true"></i> Fechar
              </button>
            </div>
          </section>

        </div>
      @endforeach

  </main>

  @push('scripts')
    <script src="{{ asset('./assets/js/charge.js') }}"></script>
  @endpush
@endsection