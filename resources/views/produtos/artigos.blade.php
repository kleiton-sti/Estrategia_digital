@extends('layouts.app')

@section('title', 'Artigos')

@section('content')
  <main class="main">
    <section id="artigos" class="primeira-sessao py-5">
      <div class="container">

        <!-- Cabeçalho autenticado -->
        @auth
          <div class="artigos-header-auth d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
            <div class="d-flex align-items-center gap-2">
              <i class="bi bi-person-circle fs-4"></i>
              <span class="artigos-nome-usuario">{{ Auth::user()->nome }}</span>
            </div>
            <a href="{{ route('artigos.criar') }}" class="btn btn-publicar">
              <i class="bi bi-plus-lg"></i> Publicar
            </a>
          </div>
        @endauth

        <div class="section-titulo mb-5 d-flex flex-column justify-content-start">
          <h1>Artigos</h1>
          <p class="text-start">Explore conteúdos sobre transformação digital, inovação e gestão pública.</p>
        </div>

        <!-- Pills de Categoria -->

        <div class="d-flex flex-wrap gap-2 mb-5" id="filtro-categorias">
          <button class="btn btn-pill active" data-categoria="todos">Todos</button>
          @foreach($categorias as $cat)
            <button class="btn btn-pill" data-categoria="{{ Str::slug($cat->nome) }}">{{ $cat->nome }}</button>
          @endforeach
        </div>


        @if(session('sucesso'))
          <div class="alert alert-success">{{ session('sucesso') }}</div>
        @endif

        <!-- Grid de cards -->
        <div class="row gy-4" id="grid-artigos">

          @forelse ($artigos as $artigo)
            <div class="col-lg-4 col-md-6 h-100" data-categoria="{{ Str::slug($artigo->categoria->nome ?? '') }}">
              <a href="{{ route('artigos.conteudo', $artigo->id) }}" class="artigo-card-link">
                <div class="artigo-card">
                  <div class="artigo-card-img">
                    <img src="{{ asset('assets/img/misc/misc.png') }}" alt="Capa do artigo" class="img-fluid">
                    <span class="artigo-badge">{{ $artigo->categoria->nome ?? '-' }}</span>
                  </div>
                  <div class="artigo-card-body d-flex flex-column p-3">
                    <div class="artigo-data d-flex gap-3">
                      <span><i class="bi bi-calendar3"></i> {{ $artigo->created_at->format('d/m/Y') }}</span>
                    </div>
                    <h5 class="artigo-titulo">{{ $artigo->titulo }}</h5>
                    <p class="artigo-subtitulo mb-3 flex-grow-1">{{ $artigo->subtitulo }}</p>
                  </div>
                </div>
              </a>
            </div>
          @empty
            <div class="col-12">
              <p class="artigos-vazio">Nada publicado ainda.</p>
            </div>
          @endforelse

        </div>
      </div>
    </section>
  </main>
@endsection

@push('scripts')
  <script src="{{ asset('assets/js/filtro-categoria.js') }}"></script>
@endpush