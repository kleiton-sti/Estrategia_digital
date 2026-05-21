@extends('layouts.app')

@section('content')
<main class="main pagina-interna roadmap-page">

    <!-- Hero -->
    <section class="roadmap-hero section">
        <div class="container roadmap-hero__inner" data-aos="fade-up">
            <div class="roadmap-hero__texto">
                <span class="roadmap-hero__label">ROTEIRO DIGITAL</span>
                <h1 class="roadmap-hero__titulo">Roadmap</h1>
                <p class="roadmap-hero__sub">
                    O roteiro que orienta a Prefeitura rumo a um governo 100% digital,
                    transparente e conectado com o munícipe.
                </p>
            </div>
            <div class="roadmap-scroll-hint" aria-hidden="true">
                <span class="roadmap-scroll-hint__texto">ACOMPANHE NOSSO PROGRESSO</span>
                <div class="roadmap-scroll-hint__icone">
                    <i class="bi bi-chevron-double-down"></i>
                </div>
            </div>

            <!-- trilha neon -->
            <div class="rd-trilha">
                <svg class="rd-trilha-svg" viewBox="0 0 1200 120" preserveAspectRatio="none" aria-hidden="true">
                    <path class="rd-trilha-glow"
                          d="M0,60 C80,15 160,100 240,55 C320,10 400,90 480,50
                             C560,10 640,95 720,48 C800,5 880,85 960,52
                             C1040,20 1120,80 1200,40"/>
                    <path class="rd-trilha-linha"
                          d="M0,60 C80,15 160,100 240,55 C320,10 400,90 480,50
                             C560,10 640,95 720,48 C800,5 880,85 960,52
                             C1040,20 1120,80 1200,40"/>
                    <circle class="rd-particula rd-particula--1" r="3">
                        <animateMotion dur="6s" repeatCount="indefinite"
                            path="M0,60 C80,15 160,100 240,55 C320,10 400,90 480,50
                                  C560,10 640,95 720,48 C800,5 880,85 960,52
                                  C1040,20 1120,80 1200,40"/>
                    </circle>
                    <circle class="rd-particula rd-particula--2" r="2">
                        <animateMotion dur="9s" begin="-3s" repeatCount="indefinite"
                            path="M0,60 C80,15 160,100 240,55 C320,10 400,90 480,50
                                  C560,10 640,95 720,48 C800,5 880,85 960,52
                                  C1040,20 1120,80 1200,40"/>
                    </circle>
                </svg>
            </div>
        </div>
    </section>

    <!-- Linha do tempo -->
    <section id="trilha" class="roadmap-content section">
        <div class="container">

            <div class="roadmap-section-titulo" data-aos="fade-up">
                <h2>No que estamos trabalhando?</h2>
                <p>Acompanhe as iniciativas em andamento, entregues recentemente e em exploração para cada eixo estratégico.</p>
            </div>

            <!-- wrapper com linha vertical central -->
            <div class="rd-timeline-wrap">
                <div class="rd-trilha-vertical"></div>

                @foreach($eixos as $eixo)
                @php
                    $ordemDesejada   = ['entregue_recentemente', 'em_andamento', 'explorando'];
                    $labels          = [
                        'entregue_recentemente' => 'Entregue Recentemente',
                        'em_andamento'          => 'Em Andamento',
                        'explorando'            => 'Explorando',
                    ];
                    $icones          = [
                        'entregue_recentemente' => 'bi-check2-circle',
                        'em_andamento'          => 'bi-arrow-repeat',
                        'explorando'            => 'bi-lightbulb',
                    ];
                    $gruposExistentes = $eixo->roadmaps->groupBy('status');
                    $lado = $loop->iteration % 2 === 0 ? 'direita' : 'esquerda';
                @endphp

                <!-- bloco do eixo -->
                <div class="rd-eixo-bloco rd-eixo-bloco--{{ $lado }}">

                    <!-- planeta centralizado na linha -->
                    <div class="rd-planeta rd-planeta--{{ $loop->iteration }}" data-aos="zoom-in">
                        <div class="rd-planeta__nucleo">
                            <span class="rd-planeta__num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="rd-planeta__anel"></div>
                        <div class="rd-planeta__halo"></div>
                        <h3 class="rd-planeta__titulo">{{ $eixo->titulo }}</h3>
                    </div>

                    <!-- cards do lado alternado -->
                    <div class="rd-eixo rd-eixo--{{ $lado }}" data-aos="fade-up">
                        @foreach($ordemDesejada as $status)
                        @php
                            $acoes = $gruposExistentes->get($status, collect());
                            $mods  = ['entregue_recentemente' => 'verde', 'em_andamento' => 'amarelo', 'explorando' => 'roxo'];
                            $cor   = $mods[$status];
                        @endphp
                        <div class="rd-nebulosa rd-nebulosa--{{ $cor }}">
                            <div class="rd-nebulosa__glow" aria-hidden="true"></div>
                            <div class="rd-card">
                                <div class="rd-card__header">
                                    <i class="bi {{ $icones[$status] }} rd-card__icone rd-card__icone--{{ $cor }}"></i>
                                    <span class="rd-card__titulo rd-card__titulo--{{ $cor }}">{{ $labels[$status] }}</span>
                                </div>
                                <ul class="rd-card__lista">
                                    @forelse($acoes as $acao)
                                        <li class="rd-card__item">{{ $acao->acao }}</li>
                                    @empty
                                        <li class="rd-card__item rd-card__item--vazio">Nenhuma ação registrada.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
                @endforeach

            </div>

        </div>
    </section>

</main>
@endsection
