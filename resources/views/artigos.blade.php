@extends('layouts.app')

@section('title', 'Artigos')

@section('content')
  <main class="main pagina-interna">
    <section id="artigos" class="primeira-sessao py-5">
      <div class="container" data-aos="fade-up">

        @auth
          <div class="artigos-header-auth">
            <div class="artigos-auth-usuario">
              <i class="bi bi-person-circle"></i>
              <span class="artigos-nome-usuario">{{ Auth::user()->nome }}</span>
            </div>
            <div class="artigos-auth-acoes">
              <a href="{{ route('artigos.criar') }}" class="btn-artigo-publicar">
                <i class="bi bi-plus-lg" aria-hidden="true"></i> Publicar
              </a>
              <form action="{{ route('sair') }}" method="POST">
                @csrf
                <button type="submit" class="btn-artigo-sair">
                  <i class="bi bi-box-arrow-right" aria-hidden="true"></i> Sair
                </button>
              </form>
            </div>
          </div>
        @endauth

        <div class="section-titulo mb-5 d-flex flex-column justify-content-start">
          <h1>Artigos</h1>
          <p>Explore conteudos sobre transformacao digital, inovacao e gestao publica.</p>
        </div>

        <!-- Pills de filtro por categoria -->
        <div class="d-flex flex-wrap gap-2 mb-5">

          @php $rotaBase = Auth::check() ? 'artigos.painel' : 'artigos'; @endphp

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
            <div class="col-lg-6 col-12">
              <a href="{{ route('artigos.conteudo', ['slug' => $artigo->slug, 'id' => $artigo->id]) }}"
                class="artigo-card-link">
                <div class="artigo-card">
                  <div class="artigo-card-body">

                    <div class="d-flex align-items-start justify-content-between gap-2 mb-3">
                      <div class="artigo-badges-wrap">
                        @foreach($artigo->categorias as $cat)
                          <span class="artigo-badge">{{ $cat->nome }}</span>
                        @endforeach
                      </div>
                      <span class="artigo-data flex-shrink-0">
                        <i class="bi bi-calendar3"></i> {{ $artigo->created_at->format('d/m/Y') }}
                      </span>
                    </div>

                    <h5 class="artigo-titulo">{{ $artigo->titulo }}</h5>
                    <p class="artigo-subtitulo">{{ Str::limit($artigo->subtitulo, 130) }}</p>

                    <div class="artigo-rodape d-flex align-items-center justify-content-between mt-auto pt-3">
                      <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-person-circle artigo-autor-icone"></i>
                        <span class="artigo-autor-nome">{{ $artigo->user->nome ?? 'Autor desconhecido' }}</span>
                      </div>
                      <span class="artigo-leia-mais">
                        Ler artigo <i class="bi bi-arrow-right"></i>
                      </span>
                    </div>

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

        @if($artigos->hasPages())
          <div class="d-flex justify-content-center mt-5">
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