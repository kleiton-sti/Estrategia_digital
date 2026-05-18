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

            <!-- Aviso informativo -->
            <p class="conteudo-aviso mb-4">
              Este conteúdo tem caráter exclusivamente informativo e educativo. Não representa oferta, promoção ou
              recomendação de produtos ou serviços. As informações aqui apresentadas visam contribuir com a
              transparência, a inovação e a conscientização sobre a transformação digital na gestão pública municipal.
            </p>

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

            <!-- Corpo do artigo renderizado como HTML -->
            <div class="conteudo-corpo">
              {!! $artigo->corpo !!}
            </div>

            <!-- Autor e data — rodapé do artigo -->
            <p class="conteudo-autoria mt-5">
              <em>Escrito por {{ $artigo->user->nome ?? 'Autor desconhecido' }} em {{ $artigo->created_at->format('d/m/Y') }}</em>
            </p>

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
