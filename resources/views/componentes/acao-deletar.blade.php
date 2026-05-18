<div class="acoes-artigo d-flex gap-3 mt-4">
    <form action="{{  route('artigos.excluir', $artigo->slug) }}" method="POST"
        onsubmit="return confirm('Confirmar exclusão do artigo?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-acao-excluir">
            <i class="bi bi-trash3"></i> Excluir
        </button>
    </form>
</div>