@extends('layouts.app')

@section('title', Str::limit($artigo->titulo, 60))

@section('meta')
  @foreach($artigo->categorias as $cat)
    <meta property="article:tag" content="{{ $cat->nome }}">
  @endforeach
  <link rel="canonical" href="{{ url()->current() }}">
@endsection



@section('content')
   @include('componentes.openGraph', ['tipo' => 'artigo', 'artigo' => $artigo])
  <main class="main pagina-interna">
    <section id="conteudo-artigo" class="primeira-sessao py-5">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
          <div class="col-lg-8">

            <article>

              <!-- Aviso informativo -->
              <p class="conteudo-aviso mb-4">
                Este conteúdo tem caráter exclusivamente informativo e educativo. Não representa oferta, promoção ou
                recomendação de produtos ou serviços. As informações aqui apresentadas visam contribuir com a
                transparência, a inovação e a conscientização sobre a transformação digital na gestão pública municipal.
              </p>

              <!-- Badges de categoria -->
              <div class="artigo-badges-conteudo mb-3">
                @foreach($artigo->categorias as $cat)
                  <span class="artigo-badge-conteudo">{{ $cat->nome }}</span>
                @endforeach
              </div>

              <!-- Titulo e subtitulo -->
              <h1 class="conteudo-titulo">{{ $artigo->titulo }}</h1>
              <p class="conteudo-subtitulo">{{ $artigo->subtitulo }}</p>

              <hr class="conteudo-divisor">

              <!-- Corpo do artigo -->
              <div class="conteudo-corpo">
                {!! $artigo->corpo !!}
              </div>

              <!-- Compartilhamento -->
              @include('componentes.compartilhar', ['artigo' => $artigo])

              <!-- Autor — schema.org/Person + itemprop para indexação rica -->
              <div class="conteudo-autor mt-5">
                <div class="conteudo-autor__avatar" aria-hidden="true">
                  <i class="bi bi-person-circle"></i>
                </div>
                <div class="conteudo-autor__info">
                  <span class="conteudo-autor__label">Escrito por</span>
                  <div class="cargo-autor">
                    <span class="conteudo-autor__nome">
                      {{ $artigo->user->nome ?? 'Autor desconhecido' }}
                    </span>
                    <span class="conteudo-autor__cargo">{{ $artigo->user->cargo }}</span>
                  </div>
                  <time
                    class="conteudo-autor__data"
                    datetime="{{ $artigo->created_at->toIso8601String() }}"
                    itemprop="datePublished"
                  >
                    {{ $artigo->created_at->translatedFormat('d \d\e F \d\e Y') }}
                  </time>
                </div>
              </div>

              <!-- Ações de edição e exclusão — somente para o autor autenticado -->
              @auth
                <div class="d-flex flex-row gap-3 mt-4">
                  @if(Auth::id() === $artigo->user_id)
                    @include('componentes.acao-editar', ['artigo' => $artigo])
                  @endif
                  @include('componentes.acao-deletar', ['artigo' => $artigo])
                </div>
              @endauth

            </article>

          </div>
        </div>
      </div>
    </section>
    @include('componentes.jsonld', ['artigo' => $artigo, 'tipo' => 'artigo'])
  </main>
@endsection
