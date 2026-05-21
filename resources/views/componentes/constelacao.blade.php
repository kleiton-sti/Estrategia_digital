{{--
    Componente: constelacao
    Parâmetros:
      $constelacao  — array com 'nos' e 'arestas' (ConstellationService::porEixo)
      $progresso    — float 0.0 a 1.0 (concluidas / total)
      $eixoId       — int (usado como seed de identidade visual)
--}}
@php
    $totalNos   = count($constelacao['nos']);
    $nosAtivos  = (int) round($progresso * $totalNos);
    $uid        = 'cst-' . $eixoId . '-' . uniqid(); // o SVG compartilha IDs no escopo global, portanto isso ajuda a tornar cada SVG único.
@endphp

<svg
    class="constelacao-svg"
    viewBox="0 0 100 60"
    xmlns="http://www.w3.org/2000/svg"
    aria-hidden="true"
    data-progresso="{{ $progresso }}"
    data-nos-ativos="{{ $nosAtivos }}"
    data-uid="{{ $uid }}"
>
    <defs>
        <!-- glow para nós principais ativos -->
        <filter id="{{ $uid }}-glow-principal" x="-80%" y="-80%" width="260%" height="260%">
            <feGaussianBlur stdDeviation="2.2" result="blur"/>
            <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
        </filter>
        <!-- glow suave para nós secundários ativos -->
        <filter id="{{ $uid }}-glow-secundario" x="-60%" y="-60%" width="220%" height="220%">
            <feGaussianBlur stdDeviation="1.2" result="blur"/>
            <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
        </filter>
        <!-- gradiente das arestas ativas -->
        <linearGradient id="{{ $uid }}-aresta-grad" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%"   stop-color="#3B82F6" stop-opacity="0.8"/>
            <stop offset="50%"  stop-color="#04C4D9" stop-opacity="0.9"/>
            <stop offset="100%" stop-color="#7c6ef0" stop-opacity="0.8"/>
        </linearGradient>
    </defs>

    <!-- arestas inativas -->
    @foreach($constelacao['arestas'] as $i => $aresta)
        @php
            $a = $constelacao['nos'][$aresta[0]];
            $b = $constelacao['nos'][$aresta[1]];
            $ativo = ($aresta[0] < $nosAtivos && $aresta[1] < $nosAtivos);
        @endphp
        <line
            class="cst-aresta {{ $ativo ? 'cst-aresta--ativa' : '' }}"
            x1="{{ $a['x'] }}" y1="{{ $a['y'] }}"
            x2="{{ $b['x'] }}" y2="{{ $b['y'] }}"
            stroke="{{ $ativo ? 'url(#' . $uid . '-aresta-grad)' : 'rgba(255,255,255,0.07)' }}"
            stroke-width="{{ $ativo ? '0.6' : '0.4' }}"
        />
    @endforeach

    <!-- nós -->
    @foreach($constelacao['nos'] as $i => $no)
        @php
            $ativo      = $i < $nosAtivos;
            $principal  = $no['principal'] ?? false;
            $filtro     = $ativo ? ($principal ? 'url(#' . $uid . '-glow-principal)' : 'url(#' . $uid . '-glow-secundario)') : 'none';
            $cor        = $ativo
                ? ($principal ? '#04C4D9' : '#3B82F6')
                : 'rgba(255,255,255,0.12)';
            $corBorda   = $ativo
                ? ($principal ? '#a8f0f7' : '#93c5fd')
                : 'rgba(255,255,255,0.08)';
        @endphp
        <circle
            class="cst-no {{ $ativo ? 'cst-no--ativo' : '' }} {{ $principal ? 'cst-no--principal' : '' }}"
            cx="{{ $no['x'] }}" cy="{{ $no['y'] }}" r="{{ $no['r'] }}"
            fill="{{ $cor }}"
            stroke="{{ $corBorda }}"
            stroke-width="0.5"
            filter="{{ $filtro }}"
        />
    @endforeach
</svg>
