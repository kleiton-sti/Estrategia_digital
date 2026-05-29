@extends('layouts.app')

@section('meta')
    <link rel="canonical" href="https://estrategiadigital.caraguatatuba.sp.gov.br/roadmap">
@endsection

@section('content')
    <main class="main pagina-interna roadmap-page">

        <!-- Hero -->
        <section class="roadmap-hero section">
            <div class="roadmap-hero__inner" data-aos="fade-up">
                <div class="roadmap-hero__texto">
                    <span class="roadmap-hero__label">ROTEIRO DIGITAL</span>
                    <h1 class="roadmap-hero__titulo">Roadmap</h1>
                    <p class="roadmap-hero__sub">
                        O roteiro que orienta a Prefeitura rumo a um governo 100% digital,
                        transparente e conectado com o munícipe.
                    </p>
                </div>
               

                <!-- trilha nebulosa -->
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
            <button
              class="roadmap-scroll-hint"
              aria-label="Ir para a linha do tempo"
              onclick="window.scrollComOffset(document.getElementById('trilha'))"
            >
                <span class="roadmap-scroll-hint__texto">ACOMPANHE NOSSO PROGRESSO</span>
                <div class="roadmap-scroll-hint__icone">
                    <i class="bi bi-chevron-double-down"></i>
                </div>
            </button>
        </section>

        <!-- Linha do tempo -->
        <section id="trilha" class="roadmap-content section">

            <div class="container">

                <div class="rd-timeline-wrap">
                    <div class="rd-trilha-vertical"></div>

                    @foreach($eixos as $eixo)
                        @php
                            $ordemDesejada = ['explorando', 'em_andamento', 'entregue_recentemente'];
                            $labels = [
                                'explorando'            => 'Explorando',
                                'em_andamento'          => 'Em Execução',
                                'entregue_recentemente' => 'Concluído',
                            ];
                            $cores = [
                                'explorando'            => 'roxo',
                                'em_andamento'          => 'amarelo',
                                'entregue_recentemente' => 'verde',
                            ];
                            $gruposExistentes = $eixo->roadmaps->groupBy('status');
                            $numEixo = $loop->iteration;
                            $numPad  = str_pad($numEixo, 2, '0', STR_PAD_LEFT);
                        @endphp

                        {{-- Separador cósmico entre eixos (a partir do 2º) --}}
                        @if(!$loop->first)
                            <div class="rd-eixo-sep" aria-hidden="true"></div>
                        @endif

                        <!-- marcador do eixo: planeta + título -->
                        <div class="rd-eixo-marcador rd-planeta--{{ $numEixo }}" data-aos="fade-up">
                            <div class="rd-planeta__nucleo">
                                <span class="rd-planeta__num">{{ $numPad }}</span>
                            </div>
                            <div class="rd-planeta__anel"></div>
                            <div class="rd-planeta__halo"></div>
                            <h3 class="rd-eixo-marcador__titulo" data-eixo="Eixo {{ $numPad }}">{{ $eixo->titulo }}</h3>
                        </div>

                        <!-- cards de status, alternando de lado -->
                        @foreach($ordemDesejada as $cardIndex => $status)
                            @php
                                $lado  = $cardIndex % 2 === 0 ? 'esquerda' : 'direita';
                                $cor   = $cores[$status];
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

                                <!-- card com nebulosa -->
                                <div class="rd-card-linha__card">
                                    <div class="rd-nebulosa rd-nebulosa--{{ $cor }}">
                                        <div class="rd-nebulosa__glow" aria-hidden="true"></div>
                                        <div class="rd-card">

                                            <div class="rd-card__header">

                                                {{-- Ícone SVG cósmico por status --}}
                                                <div class="rd-card__icone-wrap rd-card__icone-wrap--{{ $cor }}">
                                                    @if($status === 'entregue_recentemente')
                                                        {{-- Foguete --}}
                                                        <svg class="rd-icone-svg rd-icone-svg--foguete"
                                                             viewBox="0 0 24 24" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             aria-hidden="true">
                                                            <path d="M12 2C12 2 7 7 7 14H17C17 7 12 2 12 2Z"
                                                                  stroke="currentColor" stroke-width="1.5"
                                                                  stroke-linejoin="round"/>
                                                            <path d="M9 14V17C9 18.1 9.9 19 11 19H13C14.1 19 15 18.1 15 17V14"
                                                                  stroke="currentColor" stroke-width="1.5"/>
                                                            <path d="M10 19L8.5 22" stroke="currentColor"
                                                                  stroke-width="1.5" stroke-linecap="round"/>
                                                            <path d="M14 19L15.5 22" stroke="currentColor"
                                                                  stroke-width="1.5" stroke-linecap="round"/>
                                                            <circle cx="12" cy="10" r="1.5" fill="currentColor"/>
                                                            <path d="M7 14C5.5 14 4 15 4 16.5"
                                                                  stroke="currentColor" stroke-width="1.5"
                                                                  stroke-linecap="round"/>
                                                            <path d="M17 14C18.5 14 20 15 20 16.5"
                                                                  stroke="currentColor" stroke-width="1.5"
                                                                  stroke-linecap="round"/>
                                                        </svg>

                                                    @elseif($status === 'em_andamento')
                                                        {{-- Meteoro --}}
                                                        <svg class="rd-icone-svg rd-icone-svg--meteoro"
                                                             viewBox="0 0 24 24" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             aria-hidden="true">
                                                            <circle cx="14.5" cy="9.5" r="4.5"
                                                                    stroke="currentColor" stroke-width="1.5"/>
                                                            <path d="M11.5 12.5L3 21"
                                                                  stroke="currentColor" stroke-width="1.5"
                                                                  stroke-linecap="round"/>
                                                            <path d="M10 7.5L4.5 5.5"
                                                                  stroke="currentColor" stroke-width="1.2"
                                                                  stroke-linecap="round" opacity="0.55"/>
                                                            <path d="M16.5 4.5L18 2"
                                                                  stroke="currentColor" stroke-width="1.2"
                                                                  stroke-linecap="round" opacity="0.55"/>
                                                            <path d="M19.5 11.5L22 12.5"
                                                                  stroke="currentColor" stroke-width="1.2"
                                                                  stroke-linecap="round" opacity="0.55"/>
                                                        </svg>

                                                    @else
                                                        {{-- OVNI --}}
                                                        <svg class="rd-icone-svg rd-icone-svg--ovni"
                                                             viewBox="0 0 24 24" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             aria-hidden="true">
                                                            <ellipse cx="12" cy="11" rx="9" ry="4"
                                                                     stroke="currentColor" stroke-width="1.5"/>
                                                            <path d="M8.5 11.5C8.5 11.5 8 15.5 12 15.5C16 15.5 15.5 11.5 15.5 11.5"
                                                                  stroke="currentColor" stroke-width="1.5"
                                                                  stroke-linecap="round"/>
                                                            <circle cx="9"  cy="10" r="1"
                                                                    fill="currentColor" opacity="0.65"/>
                                                            <circle cx="12" cy="9.2" r="1"
                                                                    fill="currentColor" opacity="0.65"/>
                                                            <circle cx="15" cy="10" r="1"
                                                                    fill="currentColor" opacity="0.65"/>
                                                            <path d="M7.5 15.5L5.5 18.5"
                                                                  stroke="currentColor" stroke-width="1.2"
                                                                  stroke-linecap="round" opacity="0.45"/>
                                                            <path d="M12 15.5V18.5"
                                                                  stroke="currentColor" stroke-width="1.2"
                                                                  stroke-linecap="round" opacity="0.45"/>
                                                            <path d="M16.5 15.5L18.5 18.5"
                                                                  stroke="currentColor" stroke-width="1.2"
                                                                  stroke-linecap="round" opacity="0.45"/>
                                                        </svg>
                                                    @endif
                                                </div>

                                                <span class="rd-card__titulo rd-card__titulo--{{ $cor }}">
                                                    {{ $labels[$status] }}
                                                </span>
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

                </div>{{-- /rd-timeline-wrap --}}

                <!-- Botão voltar ao início — ao final da linha do tempo -->
                <div class="rd-voltar-wrap" data-aos="fade-up">
                  <button
                    class="rd-voltar-btn"
                    aria-label="Voltar ao início do roadmap"
                    onclick="window.scrollComOffset(document.querySelector('.roadmap-hero'))"
                  >
                    <i class="bi bi-arrow-up" aria-hidden="true"></i>
                    <span>Voltar ao início</span>
                  </button>
                </div>

            </div>
        </section>
        @include('componentes.jsonld', ['tipo' =>  'roadmap', 'eixos' => $eixos])
    </main>
@endsection
