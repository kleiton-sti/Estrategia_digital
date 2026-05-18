@extends('layouts.app')

@section('title', isset($artigo) ? 'Editar Artigo' : 'Publicar Artigo')

@push('styles')
<style>
  /* ── Wrapper ── */
  .tox-tinymce {
    border: 1px solid #2e2f50 !important;
    border-radius: 8px !important;
  }

  /* ── Barra de ferramentas e menubar ── */
  .tox .tox-toolbar,
  .tox .tox-toolbar__overflow,
  .tox .tox-toolbar-overlord,
  .tox .tox-toolbar__primary,
  .tox .tox-menubar,
  .tox .tox-statusbar,
  .tox-toolbar__overflow {
    background-color: #131428 !important;
    border-color: #2e2f50 !important;
  }

  /* ── TODOS os botões da toolbar: fundo transparente por padrão ── */
  .tox .tox-tbtn,
  .tox .tox-tbtn--select,
  .tox .tox-tbtn--bespoke {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    color: #c8c6e3 !important;
  }

  /* ── Label do select "Blocks / Paragraph" ── */
  .tox .tox-tbtn__select-label,
  .tox .tox-tbtn--bespoke .tox-tbtn__select-label {
    color: #c8c6e3 !important;
  }

  /* ── Ícones SVG na cor padrão ── */
  .tox .tox-icon svg,
  .tox .tox-tbtn svg {
    fill: #c8c6e3 !important;
  }

  /* ── Hover / ativo ── */
  .tox .tox-tbtn:hover,
  .tox .tox-tbtn--enabled,
  .tox .tox-tbtn--active,
  .tox .tox-tbtn--select:hover,
  .tox .tox-tbtn--bespoke:hover {
    background: #1e1f3a !important;
  }

  .tox .tox-tbtn:hover svg,
  .tox .tox-tbtn--enabled svg,
  .tox .tox-tbtn--active svg {
    fill: #3B82F6 !important;
  }

  /* ── Separadores ── */
  .tox .tox-toolbar__group:not(:last-of-type) {
    border-right: 1px solid #2e2f50 !important;
  }

  /* ── Menu items (File, Edit…) ── */
  .tox .tox-mbtn,
  .tox .tox-mbtn__select-label {
    background: transparent !important;
    color: #c8c6e3 !important;
  }

  .tox .tox-mbtn:hover,
  .tox .tox-mbtn--active {
    background-color: #1e1f3a !important;
    color: #ffffff !important;
  }

  /* ── Dropdowns / menus flutuantes ── */
  .tox .tox-menu,
  .tox .tox-collection,
  .tox .tox-collection__group {
    background-color: #1f2240 !important;
    border-color: #2e2f50 !important;
  }

  .tox .tox-collection__item {
    color: #c8c6e3 !important;
  }

  .tox .tox-collection__item--active,
  .tox .tox-collection__item:hover {
    background-color: #1e1f3a !important;
    color: #ffffff !important;
  }

  .tox .tox-collection__item svg {
    fill: #c8c6e3 !important;
  }

  /* ── Área de edição ── */
  .tox .tox-edit-area {
    border-color: #2e2f50 !important;
    background-color: #1e1f3a !important;
  }

  .tox .tox-edit-area__iframe {
    background-color: #1e1f3a !important;
  }

  /* ── Statusbar ── */
  .tox .tox-statusbar {
    border-top: 1px solid #2e2f50 !important;
    background-color: #131428 !important;
  }

  .tox .tox-statusbar a,
  .tox .tox-statusbar__wordcount,
  .tox .tox-statusbar__path-item,
  .tox .tox-statusbar__branding {
    color: #8e8e93 !important;
  }

  /* ── Dialogs / modais ── */
  .tox .tox-dialog,
  .tox .tox-dialog__header,
  .tox .tox-dialog__footer,
  .tox .tox-dialog__body,
  .tox .tox-dialog__body-content {
    background-color: #131428 !important;
    border-color: #2e2f50 !important;
    color: #e8e7f7 !important;
  }

  .tox .tox-dialog__title {
    color: #ffffff !important;
  }

  .tox .tox-label,
  .tox .tox-form__group label {
    color: #c8c6e3 !important;
  }

  .tox .tox-textfield,
  .tox .tox-textarea,
  .tox .tox-selectfield select,
  .tox .tox-listboxfield .tox-listbox--select {
    background-color: #1e1f3a !important;
    border-color: #2e2f50 !important;
    color: #e8e7f7 !important;
  }

  .tox .tox-textfield:focus,
  .tox .tox-textarea:focus {
    border-color: #3B82F6 !important;
    outline: none !important;
  }

  /* ── Botão primário nos dialogs ── */
  .tox .tox-button:not(.tox-button--secondary):not(.tox-button--icon) {
    background-color: #3B82F6 !important;
    border-color: #3B82F6 !important;
    color: #ffffff !important;
  }

  .tox .tox-button:not(.tox-button--secondary):not(.tox-button--icon):hover {
    background-color: #2563eb !important;
    border-color: #2563eb !important;
  }

  .tox .tox-button--secondary {
    background-color: transparent !important;
    border-color: #2e2f50 !important;
    color: #c8c6e3 !important;
  }

  .tox .tox-button--secondary:hover {
    background-color: #1e1f3a !important;
    color: #ffffff !important;
  }

  /* ── Tooltip ── */
  .tox .tox-tooltip__body {
    background-color: #1f2240 !important;
    color: #e8e7f7 !important;
  }

  /* ── Overlay/backdrop dos dialogs ── */
  .tox-silver-sink .tox-dialog-wrap__backdrop {
    background-color: rgba(0, 0, 0, 0.6) !important;
  }
</style>
@endpush

@section('content')
<main class="main">
  <section class="publicacao-section py-5">
    <div class="container" data-aos="fade-up">

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

          <!-- Selecao de multiplas categorias — relacao N:N -->
          <div class="publicacao-campo mb-3">
            <label class="publicacao-label">Categorias</label>
            <div class="categorias-checkboxes">
              @foreach($categorias as $cat)
                @php
                  $selecionada = isset($artigo) && $artigo->categorias->contains($cat->id);
                @endphp
                <label class="categoria-check-label">
                  <input
                    type="checkbox"
                    name="categorias[]"
                    value="{{ $cat->id }}"
                    {{ $selecionada ? 'checked' : '' }}
                    class="categoria-check-input"
                  >
                  <span>{{ $cat->nome }}</span>
                </label>
              @endforeach
            </div>
            @error('categorias')
              <span class="publicacao-erro">{{ $message }}</span>
            @enderror
          </div>

          <div class="publicacao-campo mb-3">
            <label for="titulo" class="publicacao-label">Titulo</label>
            <input type="text" id="titulo" name="titulo" class="publicacao-input"
              value="{{ isset($artigo) ? $artigo->titulo : old('titulo') }}" required>
            @error('titulo')
              <span class="publicacao-erro">{{ $message }}</span>
            @enderror
          </div>

          <div class="publicacao-campo mb-3">
            <label for="subtitulo" class="publicacao-label">Subtitulo</label>
            <input type="text" id="subtitulo" name="subtitulo" class="publicacao-input"
              value="{{ isset($artigo) ? $artigo->subtitulo : old('subtitulo') }}" required>
            @error('subtitulo')
              <span class="publicacao-erro">{{ $message }}</span>
            @enderror
          </div>

          <div class="publicacao-campo mb-4">
            <label for="corpo" class="publicacao-label">Conteudo</label>
            <textarea id="editor" name="corpo">{{ isset($artigo) ? $artigo->corpo : old('corpo') }}</textarea>
            @error('corpo')
              <span class="publicacao-erro">{{ $message }}</span>
            @enderror
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
<script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#editor',
    language: 'pt_BR',
    language_url: 'https://cdn.jsdelivr.net/npm/tinymce-i18n@23.10.9/langs7/pt_BR.js',
    license_key: 'gpl',
    height: 500,
    menubar: true,
    plugins: [
      'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
      'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
      'insertdatetime', 'media', 'table', 'help', 'wordcount'
    ],
    toolbar:
      'undo redo | blocks | bold italic underline strikethrough | ' +
      'alignleft aligncenter alignright alignjustify | ' +
      'bullist numlist outdent indent | link image media table | ' +
      'code fullscreen preview | removeformat help',
    content_style: `
      body {
        font-family: "Roboto", system-ui, -apple-system, "Segoe UI", sans-serif;
        font-size: 16px;
        line-height: 1.7;
        color: #e8e7f7;
        background-color: #1e1f3a;
        padding: 16px 20px;
        margin: 0;
      }
      a { color: #3B82F6; }
      h1, h2, h3, h4, h5, h6 { color: #ffffff; font-family: "Quicksand", sans-serif; }
      table { border-collapse: collapse; width: 100%; }
      td, th { border: 1px solid #2e2f50; padding: 8px 12px; }
      th { background-color: #131428; color: #ffffff; }
      blockquote {
        border-left: 4px solid #3B82F6;
        margin: 1em 0;
        padding: 0.5em 1em;
        color: #c8c6e3;
        background: #131428;
        border-radius: 0 6px 6px 0;
      }
      code {
        background: #131428;
        color: #3B82F6;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 0.9em;
      }
      pre {
        background: #131428;
        color: #e8e7f7;
        padding: 16px;
        border-radius: 8px;
        overflow: auto;
        border: 1px solid #2e2f50;
      }
    `,
    setup: function (editor) {
      editor.on('change', function () {
        editor.save();
      });
    }
  });
</script>
@endpush
