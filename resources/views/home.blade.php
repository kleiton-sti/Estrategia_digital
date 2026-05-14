@extends('layouts.app')

@section('content')
  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <div class="hero-content">
              <h1>Estratégia Digital</h1>
              <p>A Estratégia Digital 2025–2027 orienta as ações do Município, promovendo a transformação pelo digital e
                garantindo serviços mais simples, transparentes e acessíveis ao cidadão. O projeto fortalece a
                participação social, empodera os munícipes por meio da transparência e está estruturado em 6 eixos, 18
                objetivos e 81 iniciativas.
              </p>

              <div class="hero-buttons">
                <a href="#principios" class="btn btn-primary">Conhecer Iniciativas</a>
                <a href="#footer" class="btn btn-outline">Fale Conosco</a>
              </div>

              <div class="hero-stats justify-content-between">
                <div class="stat-item">
                  <h4 class="stat-number purecounter" data-purecounter-start="0"
                    data-purecounter-end="{{ $totalIniciativas }}" data-purecounter-duration="3"></h4>
                  <p class="badge color-laranja">Iniciativas</p>
                  <div class="blur-laranja"></div>
                </div>
                <div class="stat-item">
                  <h4 class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="{{ $concluidas }}"
                    data-purecounter-duration="3"></h4>
                  <p class="badge color-verde">Concluídas</p>
                  <div class="blur-verde"></div>
                </div>
                <div class="stat-item">
                  <h4 class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="{{ $andamento }}"
                    data-purecounter-duration="3"></h4>
                  <p class="badge color-amarelo">Em execução</p>
                  <div class="blur-amarelo"></div>
                </div>
                <div class="stat-item">
                  <h4 class="stat-number purecounter" data-purecounter-start="0"
                    data-purecounter-end="{{ $naoIniciadas }}" data-purecounter-duration="3"></h4>
                  <p class="badge color-cinza">Não iniciadas</p>
                  <div class="blur-cinza"></div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
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

      <div class="hero-bg-elements">
        <!-- <div class="bg-shape shape-1"></div>
        <div class="bg-shape shape-2"></div> -->
        <div class="bg-particles"></div>
      </div>

    </section>
    <!-- /Hero Section -->

    <!-- Eixos Section -->
    <section id="principios" class="principios section">
      <div class="container">
        <div class="reflexo-01"></div>
        <div class="section-title" data-aos="fade-up">
          <h2>Eixos</h2>
          <p>Cada eixo reúne iniciativas pensadas especialmente para você, cidadão de Caraguatatuba, aproximando a
            transformação digital da sua vida e do seu dia a dia.</p>
        </div>
        <div data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-4">
            @foreach($eixos as $eixo)
              <div class="col-lg-4 col-md-6" data-aos="fade-up">
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
                  <div class="principios-leia-mais">
                    <a href="{{ route('eixos.show', $eixo->id_eixos) }}" class="principios-link">
                      <span>Ler Mais</span><i class="bi bi-arrow-right ms-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection