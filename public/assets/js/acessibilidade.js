/* acessibilidade.js
 * Controle de tamanho de fonte, alto contraste e botão VLibras customizado.
 * Persiste preferências via localStorage.
 */
(function () {
  const TAMANHOS   = [14, 16, 18, 20, 22, 24];
  let indiceAtual  = 1;

  /* — Restaura alto contraste salvo — */
  const contrasteSalvo = localStorage.getItem('ed-alto-contraste');
  if (contrasteSalvo === 'true') {
    document.body.classList.add('alto-contraste');
  }

  /* — Restaura tamanho de fonte salvo — */
  const tamanhoSalvo = localStorage.getItem('ed-font-size');
  if (tamanhoSalvo) {
    const idx = TAMANHOS.indexOf(parseInt(tamanhoSalvo, 10));
    if (idx !== -1) indiceAtual = idx;
  }

  /* — Aplica tamanho no <html> para escalar tudo via rem — */
  function aplicarFonte() {
    indiceAtual = Math.max(0, Math.min(indiceAtual, TAMANHOS.length - 1));
    document.documentElement.style.fontSize = TAMANHOS[indiceAtual] + 'px';
    localStorage.setItem('ed-font-size', TAMANHOS[indiceAtual]);

    const btnAum = document.getElementById('btn-aumentar');
    const btnDim = document.getElementById('btn-diminuir');
    if (btnAum) {
      btnAum.disabled = indiceAtual >= TAMANHOS.length - 1;
      btnAum.style.opacity = btnAum.disabled ? '0.35' : '1';
    }
    if (btnDim) {
      btnDim.disabled = indiceAtual <= 0;
      btnDim.style.opacity = btnDim.disabled ? '0.35' : '1';
    }
  }

  aplicarFonte();

  const btnAumentar = document.getElementById('btn-aumentar');
  const btnDiminuir = document.getElementById('btn-diminuir');

  if (btnAumentar) {
    btnAumentar.addEventListener('click', () => { indiceAtual++; aplicarFonte(); });
  }

  if (btnDiminuir) {
    btnDiminuir.addEventListener('click', () => { indiceAtual--; aplicarFonte(); });
  }

  /* — Alto contraste — */
  const btnContraste = document.getElementById('btn-contraste');
  if (btnContraste) {
    btnContraste.addEventListener('click', () => {
      document.body.classList.toggle('alto-contraste');
      const ativo = document.body.classList.contains('alto-contraste');
      localStorage.setItem('ed-alto-contraste', ativo);
      btnContraste.setAttribute('aria-pressed', ativo);
    });
  }

  /* — Expansão do painel — */
  const btnAbrir = document.getElementById('btn-abrir-acessibilidade');
  const painel   = document.getElementById('painel-acessibilidade');

  if (btnAbrir && painel) {
    painel.style.display         = 'flex';
    painel.style.transformOrigin = 'right';
    painel.style.transition      = 'transform 0.25s cubic-bezier(0.34,1.56,0.64,1), opacity 0.22s ease, visibility 0s linear 0.25s';
    painel.style.transform       = 'scale(0.6) translateX(16px)';
    painel.style.opacity         = '0';
    painel.style.visibility      = 'hidden';
    painel.style.pointerEvents   = 'none';

    let aberto = false;

    function abrirPainel() {
      aberto = true;
      btnAbrir.setAttribute('aria-expanded', 'true');
      painel.style.transition    = 'transform 0.25s cubic-bezier(0.34,1.56,0.64,1), opacity 0.22s ease, visibility 0s linear 0s';
      painel.style.visibility    = 'visible';
      painel.style.pointerEvents = 'auto';
      requestAnimationFrame(() => requestAnimationFrame(() => {
        painel.style.transform = 'scale(1) translateX(0)';
        painel.style.opacity   = '1';
      }));
    }

    function fecharPainel() {
      aberto = false;
      btnAbrir.setAttribute('aria-expanded', 'false');
      painel.style.transition    = 'transform 0.25s cubic-bezier(0.34,1.56,0.64,1), opacity 0.22s ease, visibility 0s linear 0.25s';
      painel.style.transform     = 'scale(0.6) translateX(16px)';
      painel.style.opacity       = '0';
      painel.style.visibility    = 'hidden';
      painel.style.pointerEvents = 'none';
    }

    btnAbrir.addEventListener('click', (e) => {
      e.stopPropagation();
      aberto ? fecharPainel() : abrirPainel();
    });

    painel.addEventListener('click', (e) => e.stopPropagation());
    document.addEventListener('click', () => { if (aberto) fecharPainel(); });
  }

  /* — Botão VLibras customizado —
   * Injeta um botão estilizado no lado esquerdo que ativa
   * o painel oficial do VLibras ao ser clicado.
   */
  function injetarBotaoVLibras() {
    if (document.getElementById('btn-vlibras')) return;

    const btn = document.createElement('button');
    btn.id = 'btn-vlibras';
    btn.title = 'Libras';
    btn.setAttribute('aria-label', 'Ativar VLibras — tradução em Libras');
    btn.innerHTML = '<i class="bi bi-hand-index-thumb" aria-hidden="true"></i>';

    btn.addEventListener('click', () => {
      /* Tenta acionar o botão oficial do VLibras */
      const btnOficial = document.querySelector('[vw-access-button]');
      if (btnOficial) {
        btnOficial.click();
      }
    });

    document.body.appendChild(btn);
  }

  /* Aguarda o VLibras carregar antes de injetar o botão */
  if (document.readyState === 'complete') {
    injetarBotaoVLibras();
  } else {
    window.addEventListener('load', injetarBotaoVLibras);
  }

})();
