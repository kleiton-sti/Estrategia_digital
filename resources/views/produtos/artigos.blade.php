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

        <!-- Pills de filtro por categoria -->
        <!-- Cada pill e um link que recarrega a pagina com ?categoria=slug -->
        <!-- O filtro e aplicado no servidor para compatibilidade com a paginacao -->
        <div class="d-flex flex-wrap gap-2 mb-5">

          @php
            $rotaBase = Auth::check() ? 'artigos.painel' : 'artigos';
          @endphp

          <a href="{{ route($rotaBase) }}" class="btn btn-pill {{ !$categoriaSlug ? 'active' : '' }}">
            Todos
          </a>

          @foreach($categorias as $cat)
            @php $slug = Str::slug($cat->nome); @endphp
            <a href="{{ route($rotaBase, ['categoria' => $slug]) }}"
              class="btn btn-pill {{ $categoriaSlug === $slug ? 'active' : '' }}">
              {{ $cat->nome }}
            </a>
          @endforeach

        </div>

        @if(session('sucesso'))
          <div id="aviso-sucesso" class="alert alert-success">{{ session('sucesso') }}</div>
        @endif

        <!-- Grid de cards -->
        <div class="row gy-4">

          @forelse ($artigos as $artigo)

            <div class="col-10">
              <a href="{{ route('artigos.conteudo', $artigo->id) }}" class="artigo-card-link">
                <div class="artigo-card">
                  <div class="artigo-card-body">

                    <!-- Perfil do autor com icone, nome e data de publicacao -->
                    <div class="autor-perfil d-flex align-items-center gap-3 mb-3">
                      <i class="bi bi-person-circle autor-icone"></i>
                      <div>
                        <span class="autor-nome">{{ $artigo->user->nome ?? 'Autor desconhecido' }}</span>
                        <span class="autor-data d-block">{{ $artigo->created_at->format('d/m/Y') }}</span>
                      </div>
                    </div>

                    <h5 class="artigo-titulo">{{ $artigo->titulo }}</h5>
                    <p class="artigo-subtitulo">{{ Str::limit($artigo->subtitulo, 100) }}</p>

                    <!-- Badges de categoria -->
                    <div class="artigo-badges-wrap text-end">
                      @foreach($artigo->categorias as $cat)
                        <span class="artigo-badge">{{ $cat->nome }}</span>
                      @endforeach
                    </div>

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

        <!-- Paginacao -->
        <!-- withQueryString() preserva o parametro ?categoria= ao navegar entre paginas -->
        @if($artigos->hasPages())
          <div class="d-flex mr-2 justify-content-center mt-5">
            {{ $artigos->links('pagination::bootstrap-5') }}
          </div>
        @endif

      </div>
    </section>
  </main>
@endsection

@push('scripts')
  <script>
    setTimeout(function () {
      var el = document.getElementById('aviso-sucesso');
      if (el) el.remove();
    }, 3000);
  </script>
@endpush