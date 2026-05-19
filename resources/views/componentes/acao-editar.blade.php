<!-- Ações do artigo -->
<div class="acoes-artigo d-flex gap-3 mt-4">
  <a href="{{ route('artigos.editar', ['slug' => $artigo->slug, 'id' => $artigo->id]) }}" class="btn btn-acao-editar">
    <i class="bi bi-pencil-square"></i> Editar
  </a>
</div>
