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
                        <path class="rd-trilha-glow" d="M0,60 C80,15 160,100 240,55 C320,10 400,90 480,50
                                 C560,10 640,95 720,48 C800,5 880,85 960,52
                                 C1040,20 1120,80 1200,40" />
                        <path class="rd-trilha-linha" d="M0,60 C80,15 160,100 240,55 C320,10 400,90 480,50
                                 C560,10 640,95 720,48 C800,5 880,85 960,52
                                 C1040,20 1120,80 1200,40" />
                        <circle class="rd-particula rd-particula--1" r="3">
                            <animateMotion dur="6s" repeatCount="indefinite" path="M0,60 C80,15 160,100 240,55 C320,10 400,90 480,50
                                      C560,10 640,95 720,48 C800,5 880,85 960,52
                                      C1040,20 1120,80 1200,40" />
                        </circle>
                        <circle class="rd-particula rd-particula--2" r="2">
                            <animateMotion dur="9s" begin="-3s" repeatCount="indefinite" path="M0,60 C80,15 160,100 240,55 C320,10 400,90 480,50
                                      C560,10 640,95 720,48 C800,5 880,85 960,52
                                      C1040,20 1120,80 1200,40" />
                        </circle>
                    </svg>
                </div>
            </div>
        </section>

        <!-- Linha do tempo -->
        <section id="trilha" class="roadmap-content section">
            <div class="container">

                <div class="rd-timeline-wrap">
                    <div class="rd-trilha-vertical"></div>

                    @foreach($eixos as $eixo)
                        @php
                            $ordemDesejada = ['entregue_recentemente', 'em_andamento', 'explorando'];
                            $labels = [
                                'entregue_recentemente' => 'Entregue Recentemente',
                                'em_andamento' => 'Em Andamento',
                                'explorando' => 'Explorando',
                            ];
                            $icones = [
                                'entregue_recentemente' => 'bi-check2-circle',
                                'em_andamento' => 'bi-arrow-repeat',
                                'explorando' => 'bi-lightbulb',
                            ];
                            $cores = [
                                'entregue_recentemente' => 'verde',
                                'em_andamento' => 'amarelo',
                                'explorando' => 'roxo',
                            ];
                            $gruposExistentes = $eixo->roadmaps->groupBy('status');
                            $numEixo = $loop->iteration;
                        @endphp

                        <!-- marcador do eixo: planeta + título ao lado -->
                        <div class="rd-eixo-marcador rd-planeta--{{ $numEixo }}" data-aos="fade-up">
                            <div class="rd-planeta__nucleo">
                                <span class="rd-planeta__num">{{ str_pad($numEixo, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>

                            <div class="rd-planeta__halo"></div>
                            <h3 class="rd-eixo-marcador__titulo">{{ $eixo->titulo }}</h3>
                            
                        </div>

                        <!-- um card por status, alternando de lado -->
                        @foreach($ordemDesejada as $cardIndex => $status)
                            @php
                                /* alternância global contínua por card dentro do eixo */
                                $lado = $cardIndex % 2 === 0 ? 'esquerda' : 'direita';
                                $cor = $cores[$status];
                                $acoes = $gruposExistentes->get($status, collect());
                            @endphp

                            <div class="rd-card-linha rd-card-linha--{{ $lado }}"
                                data-aos="{{ $lado === 'esquerda' ? 'fade-right' : 'fade-left' }}">

                                <!-- metade vazia -->
                                <div class="rd-card-linha__vazio"></div>

                                <!-- ponto na linha -->
                                <div class="rd-card-linha__ponto">
                                    <div class="rd-ponto rd-ponto--{{ $cor }}"></div>
                                </div>

                                <!-- card -->
                                <div class="rd-card-linha__card">
                                    <div class="rd-nebulosa rd-nebulosa--{{ $cor }}">
                                        <div class="rd-nebulosa__glow" aria-hidden="true"></div>
                                        <div class="rd-card">
                                            <div class="rd-card__header">
                                                <i class="bi {{ $icones[$status] }} rd-card__icone rd-card__icone--{{ $cor }}"></i>
                                                <span
                                                    class="rd-card__titulo rd-card__titulo--{{ $cor }}">{{ $labels[$status] }}</span>
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
                                </div>

                            </div>
                        @endforeach

                    @endforeach

                </div>

            </div>
        </section>

    </main>
@endsection