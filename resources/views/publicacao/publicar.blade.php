@extends('layouts.app')

@section('title', isset($artigo) ? 'Editar Artigo' : 'Publicar Artigo')

@push('styles')
<link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css'>
@endpush

@section('content')
<main class="main">
  <section class="publicacao-section py-5">
    <div class="container">

      <div class="section-titulo mb-4">
        <h1>{{ isset($artigo) ? 'Editar Artigo' : 'Novo Artigo' }}</h1>
      </div>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $erro)
              <li>{{ $erro }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="publicacao-card">
        <form
          action="{{ isset($artigo) ? route('artigos.atualizar', $artigo->id) : route('artigos.salvar') }}"
          method="POST">

          @csrf
          @isset($artigo)
            @method('PUT')
          @endisset

          <div class="publicacao-campo mb-3">
            <label for="categoria_id" class="publicacao-label">Categoria</label>
            <select name="categoria_id" id="categoria_id" class="publicacao-select">
              <option value="">Selecione...</option>
              @foreach($categorias as $cat)
                <option value="{{ $cat->id }}"
                  {{ (isset($artigo) && $artigo->categoria_id == $cat->id) ? 'selected' : '' }}>
                  {{ $cat->nome }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="publicacao-campo mb-3">
            <label for="titulo" class="publicacao-label">Título</label>
            <input type="text" id="titulo" name="titulo" class="publicacao-input"
              value="{{ isset($artigo) ? $artigo->titulo : old('titulo') }}" required>
          </div>

          <div class="publicacao-campo mb-3">
            <label for="subtitulo" class="publicacao-label">Subtítulo</label>
            <input type="text" id="subtitulo" name="subtitulo" class="publicacao-input"
              value="{{ isset($artigo) ? $artigo->subtitulo : old('subtitulo') }}" required>
          </div>

          <div class="publicacao-campo mb-4">
            <label for="corpo" class="publicacao-label">Conteúdo</label>
            <textarea id="corpo" name="corpo">{{ isset($artigo) ? $artigo->corpo : old('corpo') }}</textarea>
          </div>

          <div class="d-flex gap-3">
            <button type="submit" class="btn-publicar-enviar">
              {{ isset($artigo) ? 'Atualizar' : 'Publicar' }}
            </button>
            <a href="{{ route('artigos.painel') }}" class="btn-publicar-cancelar">Cancelar</a>
          </div>

        </form>
      </div>

    </div>
  </section>
</main>
@endsection

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>
<script>
  new FroalaEditor('#corpo', {
    language: 'pt_br',
    heightMin: 350,
    toolbarButtons: {
      moreText: {
        buttons: ['bold','italic','underline','strikeThrough','subscript','superscript',
                  'fontFamily','fontSize','textColor','backgroundColor','clearFormatting']
      },
      moreParagraph: {
        buttons: ['alignLeft','alignCenter','alignRight','alignJustify',
                  'formatOL','formatUL','paragraphFormat','lineHeight','outdent','indent','quote']
      },
      moreRich: {
        buttons: ['insertLink','insertImage','insertTable','emoticons','specialCharacters','insertHR']
      },
      moreMisc: {
        buttons: ['undo','redo','fullscreen','print','getPDF','selectAll','html','help']
      }
    },
    pluginsEnabled: ['align','charCounter','codeBeautifier','codeView','colors','draggable',
                     'emoticons','entities','file','fontFamily','fontSize','fullscreen',
                     'image','inlineStyle','lineBreaker','link','lists','paragraphFormat',
                     'paragraphStyle','print','quote','save','specialCharacters','table',
                     'url','video','wordPaste']
  });
</script>
@endpush
