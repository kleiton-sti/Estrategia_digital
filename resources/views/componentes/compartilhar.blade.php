@php
    $urlAtual   = urlencode(url()->current());
    $tituloPost = urlencode($artigo->titulo . ' — Estratégia Digital Caraguatatuba');
    $links = [
        'whatsapp' => 'https://api.whatsapp.com/send?text=' . $tituloPost . '%20' . $urlAtual,
        'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . $urlAtual,
        'linkedin' => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $urlAtual,
        'twitter'  => 'https://twitter.com/intent/tweet?text=' . $tituloPost . '&url=' . $urlAtual,
    ];
@endphp

<div class="compartilhar-wrap mt-4">
    <span class="compartilhar-label">Compartilhar</span>
    <div class="compartilhar-botoes">

        <a href="{{ $links['whatsapp'] }}" target="_blank" rel="noopener noreferrer"
           class="compartilhar-btn compartilhar-btn--whatsapp"
           aria-label="Compartilhar no WhatsApp" title="WhatsApp">
            <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
        </a>

        <a href="{{ $links['facebook'] }}" target="_blank" rel="noopener noreferrer"
           class="compartilhar-btn compartilhar-btn--facebook"
           aria-label="Compartilhar no Facebook" title="Facebook">
            <i class="fa-brands fa-facebook-f" aria-hidden="true"></i>
        </a>

        <a href="{{ $links['linkedin'] }}" target="_blank" rel="noopener noreferrer"
           class="compartilhar-btn compartilhar-btn--linkedin"
           aria-label="Compartilhar no LinkedIn" title="LinkedIn">
            <i class="fa-brands fa-linkedin-in" aria-hidden="true"></i>
        </a>

        <a href="{{ $links['twitter'] }}" target="_blank" rel="noopener noreferrer"
           class="compartilhar-btn compartilhar-btn--twitter"
           aria-label="Compartilhar no X (Twitter)" title="X / Twitter">
            <i class="fa-brands fa-x-twitter" aria-hidden="true"></i>
        </a>

        {{-- Instagram não tem API de compartilhamento por URL --}}
        <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"
           class="compartilhar-btn compartilhar-btn--instagram"
           aria-label="Instagram — copie o link e compartilhe nos Stories"
           title="Instagram">
            <i class="fa-brands fa-instagram" aria-hidden="true"></i>
        </a>

        <button type="button"
                class="compartilhar-btn compartilhar-btn--copiar"
                aria-label="Copiar link do artigo"
                title="Copiar link"
                onclick="copiarLink(this)">
            <i class="fa-regular fa-copy" aria-hidden="true"></i>
        </button>

    </div>
</div>

@push('scripts')
<script>
function copiarLink(btn) {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const icon = btn.querySelector('i');
        icon.className = 'fa-solid fa-check';
        btn.classList.add('compartilhar-btn--copiado');
        setTimeout(() => {
            icon.className = 'fa-regular fa-copy';
            btn.classList.remove('compartilhar-btn--copiado');
        }, 2000);
    });
}
</script>
@endpush