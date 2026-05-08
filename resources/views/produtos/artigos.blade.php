@extends('layouts.app')

@section('content')
<main class="main">
  <section id="artigos" class="primeira-sessao py-5">
    <div class="container">

      <div class="section-titulo mb-5 d-flex flex-column justify-content-start">
        <h1>Artigos</h1>
        <p class="text-start">Explore conteúdos sobre transformação digital, inovação e gestão pública.</p>
      </div>

      <!-- Pills de Categoria -->
      <div class="d-flex flex-wrap gap-2 mb-5" id="filtro-categorias">
        <button class="btn btn-pill active" data-categoria="todos">Todos</button>
        <button class="btn btn-pill" data-categoria="transformacao-digital">Transformação Digital</button>
        <button class="btn btn-pill" data-categoria="inovacao">Inovação</button>
        <button class="btn btn-pill" data-categoria="gestao-publica">Gestão Pública</button>
        <button class="btn btn-pill" data-categoria="tecnologia">Tecnologia</button>
        <button class="btn btn-pill" data-categoria="cidadania">Cidadania</button>
      </div>

      <!-- Grid de cards -->
      <div class="row gy-4" id="grid-artigos">


        @foreach ($artigos as $artigo)

        <div class="col-lg-4 col-md-6 h-100" data-categoria="{{ $artigo->categoria['nome'] }}" data-aos="fade-up" data-aos-delay="100">
          <div class="artigo-card">
            <div class="artigo-card-img">
              <img src="assets/img/misc/misc.png" alt="Capa do artigo" class="img-fluid">
              <span class="artigo-badge">{{ $artigo->categoria['nome'] }}</span>
            </div>

            <div class="artigo-card-body d-flex flex-column p-3">
              <div class="artigo-data d-flex gap-3">
                <span><i class="bi bi-calendar3"></i> {{ $artigo->created_at }}</span>
              </div>
              <h5 class="artigo-titulo">{{ $artigo->titulo }}</h5>
              <p class="artigo-subtitulo mb-3 flex-grow-1">{{ $artigo->subtitulo }}</p>
            </div>

          </div>
        </div>

        @endforeach


  </section>
</main>
@endsection
