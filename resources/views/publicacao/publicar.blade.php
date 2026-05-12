@extends('layouts.app')

@section('title', isset($artigo) ? 'Editar Artigo' : 'Publicar Artigo')

@push('styles')
<link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css'>
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
          <!-- O name usa array (categorias[]) para enviar varios ids -->
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
            <textarea id="corpo" name="corpo">{{ isset($artigo) ? $artigo->corpo : old('corpo') }}</textarea>
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
<script src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>
<script src='{{ asset('assets/js/froala-editor.js') }}'></script>
@endpush
