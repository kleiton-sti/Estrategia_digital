<!-- Ações do artigo -->
<div class="acoes-artigo d-flex gap-3 mt-4">
  <a href="{{ route('artigos.editar', $artigo->id) }}" class="btn btn-acao-editar">
    <i class="bi bi-pencil-square"></i> Editar
  </a>

  <form action="{{ route('artigos.excluir', $artigo->id) }}" method="POST"
        onsubmit="return confirm('Confirmar exclusão do artigo?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-acao-excluir">
      <i class="bi bi-trash3"></i> Excluir
    </button>
  </form>
</div>
