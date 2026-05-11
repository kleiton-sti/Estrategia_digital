@extends('layouts.app')

@section('title', 'Artigos')

@section('content')
  <main class="main">
    <section id="artigos" class="primeira-sessao py-5">
      <div class="container">

        <!-- Cabecalho exibido quando o usuario esta autenticado -->
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
          <p class="text-start">Explore conteudos sobre transformacao digital, inovacao e gestao publica.</p>
        </div>

        <!-- Pills de categoria -->
        <!-- data-categoria em cada pill deve bater com os slugs em data-categorias dos cards -->
        <div class="d-flex flex-wrap gap-2 mb-5" id="filtro-categorias">
          <button class="btn btn-pill active" data-categoria="todos">Todos</button>
          @foreach($categorias as $cat)
            <button class="btn btn-pill" data-categoria="{{ Str::slug($cat->nome) }}">{{ $cat->nome }}</button>
          @endforeach
        </div>

        @if(session('sucesso'))
          <div id="sucesso" class="alert alert-success">{{ session('sucesso') }}</div>
        @endif

        <!-- Grid de cards -->
        <!-- data-categorias: slugs separados por espaco, usados pelo filtro JS -->
        <div class="row gy-4" id="grid-artigos">

          @forelse ($artigos as $artigo)

            <div class="col-lg-4 col-md-6 artigo-col"
                 data-categorias="{{ $artigo->categorias->map(fn($c) => Str::slug($c->nome))->join(' ') }}">
              <a href="{{ route('artigos.conteudo', $artigo->id) }}" class="artigo-card-link">
                <div class="artigo-card">
                  <div class="artigo-card-body">

                    <!-- Badges de categoria -->
                    <div class="artigo-badges-wrap">
                      @foreach($artigo->categorias as $cat)
                        <span class="artigo-badge">{{ $cat->nome }}</span>
                      @endforeach
                    </div>

                    <span class="artigo-data">
                      <i class="bi bi-calendar3"></i> {{ $artigo->created_at->format('d/m/Y') }}
                    </span>
                    <h5 class="artigo-titulo">{{ $artigo->titulo }}</h5>
                    <p class="artigo-subtitulo">{{ Str::limit($artigo->subtitulo, 100) }}</p>
                    <span class="artigo-leia-mais">
                      Ler artigo <i class="bi bi-arrow-right"></i>
                    </span>

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
  <script>
    setTimeout(function () {
      var el = document.getElementById('sucesso');
      if (el) el.remove();
    }, 3000);
  </script>
@endpush
