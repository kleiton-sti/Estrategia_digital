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
   * Usa o SVG original do VLibras (logo público) dentro do
   * botão estilizado — mesmo visual, posicionamento e estilo nossos.
   */
  function injetarBotaoVLibras() {
    if (document.getElementById('btn-vlibras')) return;

    const btn = document.createElement('button');
    btn.id = 'btn-vlibras';
    btn.title = 'VLibras — Tradução em Libras';
    btn.setAttribute('aria-label', 'Ativar VLibras — tradução em Libras');
    btn.innerHTML = `<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M22.6288 12.7392C22.6536 12.6999 22.8732 12.3289 22.9801 11.4231C23.0862 10.525 22.7342 9.7973 22.7194 9.76667C22.7037 9.73472 22.6806 9.7082 22.6531 9.68828C22.5897 9.64217 22.5027 9.63081 22.4258 9.66588C22.316 9.71611 22.2692 9.84275 22.3213 9.9488C22.3245 9.95522 22.6343 10.5963 22.5426 11.3751C22.4466 12.1886 22.2523 12.5192 22.2523 12.5192C22.1895 12.6193 22.2241 12.7484 22.3264 12.8107C22.4302 12.8715 22.5658 12.8393 22.6288 12.7392Z"></path><path d="M21.3889 12.5831C21.4986 12.6338 21.63 12.5892 21.6826 12.4835C21.7031 12.4422 21.8843 12.0525 21.8999 11.1409C21.9152 10.2375 21.4916 9.54567 21.4735 9.51686C21.4586 9.49265 21.4391 9.47239 21.4174 9.45642C21.3479 9.40587 21.2504 9.39796 21.1714 9.4439C21.0672 9.50434 21.0332 9.6346 21.0957 9.73505L21.0959 9.73533C21.1056 9.75132 21.4725 10.357 21.4598 11.134C21.4456 11.9526 21.2856 12.2999 21.2856 12.2999C21.233 12.4056 21.2795 12.5327 21.3889 12.5831Z"></path><path d="M19.4548 15.2663C19.6737 14.7797 20.3285 13.5204 20.706 11.9494C21.0838 10.3783 20.2851 9.63822 20.2851 9.63822C18.4847 8.86178 18.0592 7.94848 17.6278 7.76009C17.3771 7.65059 17.0069 7.60431 16.6309 7.60431C16.3593 7.60431 16.0851 7.62836 15.8505 7.67018C15.2902 7.77014 13.2106 8.63485 12.2797 9.14304C11.3487 9.65156 9.88799 10.0201 9.88799 10.0201C9.88799 10.0201 9.88799 10.0201 9.55773 10.1365C9.22798 10.253 8.42008 10.1204 8.25802 10.4135C8.09528 10.7066 8.54747 11.0274 8.8791 11.1491C9.10468 11.2324 9.27255 11.336 9.99745 11.336C10.334 11.336 10.7912 11.3136 11.4298 11.2565C11.5372 11.2468 11.6363 11.242 11.7273 11.242C13.344 11.2422 12.4814 12.7145 11.9889 13.6644C11.4684 14.6676 8.20833 18.6368 7.99232 18.9215C7.77647 19.2062 7.84307 19.5158 8.06984 19.7348C8.19297 19.8535 8.3417 19.9385 8.50205 19.9385C8.63729 19.9385 8.78074 19.8777 8.92367 19.7254C9.23754 19.3931 11.8742 16.8802 12.4865 16.2338C12.6911 16.0179 12.858 15.9315 12.9795 15.9315C13.2219 15.9316 13.2852 16.274 13.1105 16.6168C12.8487 17.1311 10.8699 21.3052 10.7895 21.5703C10.7094 21.8344 10.8608 22.2329 11.0523 22.339C11.1344 22.3848 11.2772 22.4246 11.4292 22.4246C11.6305 22.4246 11.8477 22.3548 11.9621 22.1363C12.5268 21.058 14.4087 17.8847 14.7439 17.3633C14.8786 17.1545 14.9855 17.0712 15.066 17.0713C15.1863 17.0713 15.2475 17.2581 15.2531 17.4895C15.2628 17.8756 14.7408 21.8247 14.7133 22.4182C14.6886 22.9504 15.1449 22.9778 15.2393 22.9778C15.25 22.9778 15.256 22.9774 15.256 22.9774C15.256 22.9774 15.3052 23 15.3786 23C15.5327 23 15.7934 22.901 15.9321 22.2876C16.0757 21.6503 16.5036 18.8693 16.7834 17.6665C16.8995 17.1652 17.0508 16.9979 17.1932 16.9979C17.3925 16.9979 17.5742 17.3261 17.6162 17.5263C17.6882 17.8687 17.9381 20.5257 18.0474 21.2161C18.1015 21.5527 18.3303 21.6872 18.5573 21.6872C18.7958 21.6872 19.032 21.5383 19.0597 21.3187C19.1126 20.8894 19.2077 19.7307 19.1544 18.0887C19.102 16.4471 19.2357 15.7536 19.4548 15.2663Z"></path><path d="M4.1856 11.3767C4.28311 11.8991 4.4612 13.2967 5.04915 14.8067C5.63642 16.3171 6.72676 16.5063 6.72676 16.5063C7.17741 16.4334 7.57069 16.4059 7.91479 16.4059C8.17128 16.4059 8.40044 16.4212 8.60571 16.4443C10.005 14.6804 10.8159 13.5898 11.0196 13.197L11.1033 13.0368C11.1978 12.8568 11.3545 12.5577 11.4625 12.3028C10.8624 12.3554 10.3825 12.3809 9.99745 12.3809C9.21175 12.3809 8.86442 12.2706 8.55021 12.1475C8.53091 12.14 8.51178 12.1324 8.49351 12.1256C8.26571 12.042 7.50084 11.7146 7.23 11.0154C7.0881 10.6492 7.11406 10.2602 7.30173 9.92196C7.69296 9.21468 8.50819 9.1768 8.99538 9.15424L8.99878 9.15408C9.07205 9.15063 9.1757 9.14575 9.22934 9.13975L9.51572 9.03864L9.56405 9.02167L9.61356 9.00916C9.90762 8.93506 10.6686 8.71554 11.3011 8.44581C11.2364 6.94973 11.6155 2.5407 11.631 2.21217C11.6472 1.85927 11.4138 1.63713 11.0994 1.57619C11.04 1.56483 10.9805 1.55825 10.9227 1.55825C10.6725 1.55825 10.4496 1.67912 10.3933 2.03959C10.3233 2.48422 9.5707 5.9844 9.43255 6.8496C9.36937 7.24301 9.22661 7.39929 9.08232 7.39929C8.90933 7.39929 8.73463 7.17451 8.69262 6.86426C8.61561 6.2958 7.86577 1.7636 7.78039 1.50028C7.6974 1.24438 7.35945 1 7.13797 1C7.13199 1 7.12618 1.00016 7.12037 1.00049C6.90026 1.01399 6.4257 1.22824 6.47863 1.65508C6.62805 2.85441 6.88386 6.50214 6.90402 7.11473C6.91392 7.42778 6.84425 7.54717 6.74315 7.54717C6.64616 7.54717 6.51962 7.43668 6.40726 7.28172C6.17775 6.96537 4.34407 3.39784 4.02627 2.88965C3.88863 2.66932 3.72538 2.60674 3.58433 2.60674C3.39956 2.60674 3.25321 2.71378 3.25321 2.71378C3.25321 2.71378 2.73716 2.78541 3.08637 3.6488C3.33313 4.25678 4.57358 6.8007 5.03174 7.95145C5.28021 8.57442 5.15554 8.75984 4.94806 8.75984C4.77217 8.75984 4.53686 8.62646 4.4192 8.51332C4.16237 8.26631 2.42859 6.18728 1.94071 5.67118C1.80324 5.52627 1.6562 5.4683 1.5201 5.4683C1.17122 5.4683 0.894593 5.84887 1.03923 6.12619C1.24091 6.51219 1.82765 7.52757 2.81485 8.86655C3.80137 10.2054 4.08826 10.854 4.1856 11.3767Z"></path><path d="M5.91239 17.7468C5.99931 17.7468 6.08194 17.6966 6.11644 17.6138C6.16221 17.5051 6.10739 17.3814 5.99469 17.3375C5.98803 17.3348 5.30941 17.0654 4.83041 16.4326C4.32989 15.7712 4.24075 15.401 4.24075 15.401C4.21667 15.2861 4.10003 15.2115 3.98118 15.235C3.86216 15.2581 3.78497 15.3702 3.80905 15.4852C3.81844 15.5303 3.91749 15.9464 4.47453 16.683C5.02713 17.4127 5.79729 17.7187 5.82991 17.7312C5.85689 17.7417 5.88489 17.7468 5.91239 17.7468Z"></path><path d="M4.78123 18.2799C4.86046 18.2799 4.9373 18.2382 4.97641 18.1658C5.03276 18.0619 4.9911 17.9336 4.88317 17.8791C4.87668 17.8759 4.22862 17.5443 3.8152 16.8696C3.38367 16.1645 3.3321 15.7877 3.3321 15.7877C3.31981 15.6713 3.21138 15.5884 3.09064 15.5982C2.96974 15.6102 2.8818 15.7144 2.89426 15.8312C2.89887 15.8768 2.95539 16.3005 3.4361 17.0855C3.91287 17.8638 4.6482 18.24 4.67945 18.2559C4.7119 18.2722 4.74673 18.2799 4.78123 18.2799Z"></path></svg>`;

    btn.addEventListener('click', () => {
      const btnOficial = document.querySelector('[vw-access-button]');
      if (btnOficial) btnOficial.click();
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
