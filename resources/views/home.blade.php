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
              <p>Transformação digital que garante serviços mais simples.</p>

              <div class="satelite-eixos">
              </div>
              <div class="satelite-objetivos"></div>
              <div class="satelite-iniciativas"></div>

              <!-- <div class="hero-buttons">
                              <a href="#principios" class="btn btn-primary">Conhecer Iniciativas</a>
                              <a href="#footer" class="btn btn-outline">Fale Conosco</a>
                            </div> -->

              <!-- <div class="hero-stats">

                              <div class="stat-item stat-item--laranja">
                                <h4 class="stat-number purecounter" data-purecounter-start="0"
                                  data-purecounter-end="{{ $totalIniciativas }}" data-purecounter-duration="3"></h4>
                                <p class="badge color-laranja">Iniciativas</p>
                              </div>

                              <div class="stat-item stat-item--verde">
                                <h4 class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="{{ $concluidas }}"
                                  data-purecounter-duration="3"></h4>
                                <p class="badge color-verde">Concluídas</p>
                              </div>

                              <div class="stat-item stat-item--amarelo">
                                <h4 class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="{{ $andamento }}"
                                  data-purecounter-duration="3"></h4>
                                <p class="badge color-amarelo">Em execução</p>
                              </div>

                              <div class="stat-item stat-item--vermelho">
                                <h4 class="stat-number purecounter" data-purecounter-start="0"
                                  data-purecounter-end="{{ $naoIniciadas }}" data-purecounter-duration="3"></h4>
                                <p class="badge color-vermelho">Não iniciadas</p>
                              </div>

                            </div> -->

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
                <!-- <div id="reflexo-img-8"></div> -->
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
    <!-- /Eixos Section -->

  </main>
@endsection