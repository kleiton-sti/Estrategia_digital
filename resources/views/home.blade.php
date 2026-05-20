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
                        <span class="ist-num ist-num--verde purecounter"
                          data-purecounter-start="0"
                          data-purecounter-end="{{ $concluidas }}"
                          data-purecounter-duration="3"></span>
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
                      <span class="ist-num ist-num--amarelo purecounter"
                        data-purecounter-start="0"
                        data-purecounter-end="{{ $andamento }}"
                        data-purecounter-duration="3"></span>
                      <span class="ist-pill ist-pill--amarelo">Em execução</span>
                    </div>

                    <!-- não iniciadas -->
                    <div class="stat-col">
                      <span class="ist-num ist-num--vermelho purecounter"
                        data-purecounter-start="0"
                        data-purecounter-end="{{ $naoIniciadas }}"
                        data-purecounter-duration="3"></span>
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
                <div id="reflexo-img-8"></div>
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
        <div class="reflexo-01"></div>
        <div class="reflexo-02"></div>
        <div class="reflexo-03"></div>
        <div class="section-title">
          <h2>Eixos</h2>
          <p>Cada eixo reúne iniciativas pensadas especialmente para você, cidadão de Caraguatatuba, aproximando a
            transformação digital da sua vida e do seu dia a dia.</p>
        </div>
        <div>
          <div class="row gy-4">
            @foreach($eixos as $eixo)
              <div class="col-lg-4 col-md-6">
                <div class="principios-card">
                  <h4>
                    <span class="principios-icon">
                      <i class="{{ $eixosIcons[$eixo->id_eixos] ?? 'bi-question-circle' }}"></i>
                    </span>
                    <a href="{{ route('eixos.show', $eixo->id_eixos) }}" class="principio-btn text-decoration-none">
                      {{ $eixo->titulo }}
                    </a>
                  </h4>
                  <p class="small">{{ $eixo->descricao }}</p>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
    <!-- /Eixos Section -->

  </main>

  @push('scripts')
    <script src="{{ asset('./assets/js/charge.js') }}"></script>
  @endpush
@endsection
