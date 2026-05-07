@extends('layouts.app')

@section('content')
<main class="main">
  <section id="regulamentacoes" class="section py-5">
    <div class="container" data-aos="fade-up">

      <style>
        .texto-esquerda-flex {
          display: flex !important;
          /* só se ainda não for flex */
          justify-content: flex-start !important;
          /* alinha no eixo principal (geralmente horiz.) */
          align-items: flex-start !important;
          /* alinha no eixo cruzado (geralmente vert.) */
        }

        .alinha-texto-esquerda {
          text-align: left !important;
        }

        
      </style>

      <div class="section-title texto-esquerda-flex mb-5">
        <h1>Regulamentações</h1>
        <p class="alinha-texto-esquerda ">Confira as principais publicações e atualizações.</p>
      </div>

      <div class="timeline">
        @foreach($regulamentacoes as $item)
          <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
            <div class="timeline-date">
              @if($item->publicado_em)
              Publicado em: {{ \Carbon\Carbon::parse($item->publicado_em)->locale('pt_BR')->isoFormat('DD [de] MMMM [de] YYYY') }}
              @else
              Em breve!!
              @endif
            </div>
            <div class="timeline-content">
              <a target="_blank" href="{{$item->link}}"><h4>{{ $item->titulo }}</h4></a>
              <p>{{ $item->descricao }}</p>
              @if($item->link)
              <a target="_blank" href="{{$item->link}}">Leia mais</a>
              @endif
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </section>
</main>
@endsection
