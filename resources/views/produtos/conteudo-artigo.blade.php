@extends('layouts.app')

@section('title', Str::limit($artigo->titulo, 60))

@section('meta')
  <meta property="og:title" content="{{ $artigo->titulo }}">
  <meta property="og:description" content="{{ $artigo->subtitulo }}">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="article">
@endsection

@section('content')
  <main class="main">
    <section id="conteudo-artigo" class="primeira-sessao py-5">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
          <div class="col-lg-8">

            <!-- Perfil do autor com icone, nome e data de publicacao -->
            <div class="autor-perfil d-flex align-items-center gap-3 mb-3">
              <i class="bi bi-person-circle autor-icone"></i>
              <div>
                <span class="autor-nome">{{ $artigo->user->nome ?? 'Autor desconhecido' }}</span>
                <span class="autor-data d-block">{{ $artigo->created_at->format('d/m/Y') }}</span>
              </div>
            </div>

            <!-- Botoes de compartilhamento nas redes sociais -->
            <!-- <div class="compartilhar d-flex align-items-center gap-3 mb-4 flex-wrap">
              <span class="compartilhar-label">Compartilhar:</span>
              <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                 target="_blank" class="compartilhar-link" title="LinkedIn">
                <i class="bi bi-linkedin"></i>
              </a>
              <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                 target="_blank" class="compartilhar-link" title="Facebook">
                <i class="bi bi-facebook"></i>
              </a>
              <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($artigo->titulo) }}"
                 target="_blank" class="compartilhar-link" title="Twitter / X">
                <i class="bi bi-twitter-x"></i>
              </a>
              <a href="https://api.whatsapp.com/send?text={{ urlencode($artigo->titulo . ' ' . url()->current()) }}"
                 target="_blank" class="compartilhar-link" title="WhatsApp">
                <i class="bi bi-whatsapp"></i>
              </a>
              <a href="mailto:?subject={{ urlencode($artigo->titulo) }}&body={{ urlencode(url()->current()) }}"
                 class="compartilhar-link" title="E-mail">
                <i class="bi bi-envelope"></i>
              </a>
            </div> -->

            <!-- Badges de categoria — multiplas por artigo (N:N) -->
            <div class="artigo-badges-conteudo mb-3">
              @foreach($artigo->categorias as $cat)
                <span class="artigo-badge-conteudo">{{ $cat->nome }}</span>
              @endforeach
            </div>

            <!-- Titulo e subtitulo -->
            <h1 class="conteudo-titulo">{{ $artigo->titulo }}</h1>
            <p class="conteudo-subtitulo">{{ $artigo->subtitulo }}</p>

            <hr class="conteudo-divisor">

            <!-- Corpo do artigo renderizado como HTML (gerado pelo editor Froala) -->
            <div class="conteudo-corpo">
              {!! $artigo->corpo !!}
            </div>

            <!-- Acoes de edicao e exclusao visiveis somente para o autor autenticado -->
            @auth
              <div class="d-flex flex-row gap-3">
                @if(Auth::id() === $artigo->user_id)
                  @include('componentes.acao-editar', ['artigo' => $artigo])
                @endif
                @include('componentes.acao-deletar', ['artigo' => $artigo])
              </div>
            @endauth

          </div>
        </div>
      </div>
    </section>
  </main>
@endsection