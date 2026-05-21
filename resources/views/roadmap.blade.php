@extends('layouts.app')

@section('content')
<main class="main pagina-interna roadmap-page">

    <!-- Seção 1: Hero -->
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

            <!-- ícone animado de scroll -->
            <div class="roadmap-scroll-hint" aria-hidden="true">
                <span class="roadmap-scroll-hint__texto">ACOMPANHE NOSSO PROGRESSO</span>
                <div class="roadmap-scroll-hint__icone">
                    <i class="bi bi-chevron-double-down"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção 2: Roadmap por eixos -->
    <section class="roadmap-content section">
        <div class="container">

            <div class="roadmap-section-titulo" data-aos="fade-up">
                <h2>No que estamos trabalhando?</h2>
                <p>Acompanhe as iniciativas em andamento, entregues recentemente e em exploração para cada eixo estratégico.</p>
            </div>

            @foreach($eixos as $eixo)
            <div class="roadmap-eixo" data-aos="fade-up">

                <div class="roadmap-eixo__header">
                    <span class="roadmap-eixo__num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3 class="roadmap-eixo__titulo">{{ $eixo->titulo }}</h3>
                </div>

                <div class="roadmap-eixo__colunas">
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
                        $modificadores   = [
                            'entregue_recentemente' => 'entregue',
                            'em_andamento'          => 'andamento',
                            'explorando'            => 'explorando',
                        ];
                        $gruposExistentes = $eixo->roadmaps->groupBy('status');
                    @endphp

                    @foreach($ordemDesejada as $status)
                    @php
                        $acoes = $gruposExistentes->get($status, collect());
                        $mod   = $modificadores[$status];
                    @endphp
                    <div class="roadmap-coluna roadmap-coluna--{{ $mod }}">
                        <div class="roadmap-coluna__header">
                            <i class="bi {{ $icones[$status] }} roadmap-coluna__icone"></i>
                            <h5 class="roadmap-coluna__titulo">{{ $labels[$status] }}</h5>
                        </div>
                        <ul class="roadmap-coluna__lista">
                            @forelse($acoes as $acao)
                                <li class="roadmap-coluna__item">{{ $acao->acao }}</li>
                            @empty
                                <li class="roadmap-coluna__item roadmap-coluna__item--vazio">Nenhuma ação registrada.</li>
                            @endforelse
                        </ul>
                    </div>
                    @endforeach

                </div>
            </div>

            @if(!$loop->last)
                <hr class="roadmap-divisor">
            @endif
            @endforeach

        </div>
    </section>

</main>
@endsection
