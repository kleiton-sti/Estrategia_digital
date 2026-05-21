@extends('layouts.app')

@section('content')
    <main class="main pagina-interna">
        <section id="roadmap" class="section objetivos">
            <div class="container" data-aos="fade-up">

                <div class="roadmap">
                    <div class="section-title texto-esquerda-flex mb-4">
                        <h1>Roadmap</h1>
                        <p class="alinha-texto">
                            Este é o roteiro atual de transformação digital que orienta as ações da Prefeitura rumo
                            a um governo 100% digital, transparente e conectado.
                        </p>
                    </div>

                    <div class="">
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="subtitulo-roadmap col-12">
                        <h2>No que estamos trabalhando?</h2>
                    </div>
                </div>
                <hr class="roadmap-divisor__eixo">
                @foreach($todosEixos as $eixo)
                    <div class="nome-eixo">
                        <h3 class="nome-eixo__titulo">{{ $eixo->titulo }}</h3>
                    </div>
                    <div class="roadmap-columns">
                        @php
                            $ordemDesejada = ['entregue_recentemente', 'em_andamento', 'explorando'];
                            $gruposExistentes = $eixo->roadmaps->groupBy('status');
                            $grupos = collect();
                            foreach ($ordemDesejada as $status) {
                                $grupos->put($status, $gruposExistentes->get($status, collect()));
                            }
                        @endphp
                        @foreach($grupos as $status => $acoes)
                            <div class="roadmap-column">
                                <h5 class="roadmap-status">{{ ucwords(str_replace('_', ' ', $status)) }}</h5>
                                <ul class="roadmap-actions">
                                    @foreach($acoes as $acao)
                                        <li class="item-acao">{{ $acao->acao }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection