// Immediately invoked function usada para executar imediatamente após carregamendo dom DOM e isolar 
// letiáveis e funcções do escopo global.
(function () {
  const ring = document.getElementById('ringProgress');
  if (!ring) return;

  const TOTAL = 81;
  const CIRCUMFERENCE = 326.7;

  const svg = ring.closest('svg');

  const defs = document.createElementNS('http://www.w3.org/2000/svg', 'defs');

  defs.innerHTML =
    '<linearGradient id="ringGrad" x1="0%" y1="0%" x2="100%" y2="100%">' +
    '<stop offset="0%"   stop-color="#00db79"/>' +
    '<stop offset="100%" stop-color="#6effc6"/>' +
    '</linearGradient>';
  svg.prepend(defs);

  ring.style.strokeDasharray = CIRCUMFERENCE;
  ring.style.strokeDashoffset = CIRCUMFERENCE;

  function setProgress(value) {
    let pct = Math.min(value / TOTAL, 1);
    let offset = CIRCUMFERENCE * (1 - pct);
    ring.style.strokeDashoffset = offset;
  }

  const statEl = document.querySelector('.ring-inner .ist-num--verde');
  if (!statEl) return;

  const observer = new MutationObserver(function () {
    let v = parseInt(statEl.textContent, 10) || 0;
    setProgress(v);
  });

  observer.observe(statEl, { childList: true, characterData: true, subtree: true });

  const initial = parseInt(statEl.textContent, 10) || 0;
  if (initial > 0) setProgress(initial);

  window.atualizarAnel = function (concluidas, total) {
    let circulo = document.getElementById('ini-anel-circulo');
    if (!circulo) return;
    let raio = 26;
    let circunferencia = 2 * Math.PI * raio;
    let pct = total > 0 ? concluidas / total : 0;
    circulo.style.strokeDasharray = circunferencia;
    circulo.style.strokeDashoffset = circunferencia * (1 - pct);
  };

})();


/* Anima constelações dentro de um escopo específico.
   Sem argumento anima todas da página (usado no load inicial).
   Com argumento anima apenas as do elemento passado (usado ao abrir eixo-inline). */
window.carregarConstelacao = function (escopo) {
  let alvo = escopo || document;
  let svgs = alvo.querySelectorAll('.constelacao-svg');

  svgs.forEach(function (svg) {
    let nos = svg.querySelectorAll('.cst-no');
    let arestas = svg.querySelectorAll('.cst-aresta');

    nos.forEach(function (el) { el.classList.remove('cst-visivel'); });
    arestas.forEach(function (el) { el.classList.remove('cst-visivel'); });

    /* força reflow para que o browser processe o remove antes do add,
       garantindo que a transição de opacidade seja re-executada */
    svg.getBoundingClientRect();

    arestas.forEach(function (el, i) {
      setTimeout(function () { el.classList.add('cst-visivel'); }, 200 + i * 80);
    });
    nos.forEach(function (el, i) {
      setTimeout(function () { el.classList.add('cst-visivel'); }, 400 + i * 120);
    });
  });
};


window.addEventListener('load', function () {
  window.carregarConstelacao();
});


/* ─────────────────────────────────────────────────────────────
   Hero mobile — cérebro como fundo atrás do card de stats.
   Injeta a imagem apenas em viewports < 992px para não afetar
   o layout desktop que já tem a coluna de imagem própria.
   ───────────────────────────────────────────────────────────── */
(function () {
  function injetarFundoCerebro() {
    // Só em mobile/tablet (< 992px)
    if (window.innerWidth >= 992) return;

    let heroContent = document.querySelector('.hero .hero-content');
    if (!heroContent) return;

    // Evita duplicata em resize
    if (heroContent.querySelector('.hero-stats-mobile-bg')) return;

    // Pega a src da imagem original na coluna oculta
    let imgOriginal = document.querySelector('.hero .colunaImg img');
    if (!imgOriginal) return;

    let img = document.createElement('img');
    img.src = imgOriginal.src;
    img.alt = '';
    img.className = 'hero-stats-mobile-bg';
    img.setAttribute('aria-hidden', 'true');

    // Insere como primeiro filho do hero-content (fica abaixo dos elementos via z-index)
    heroContent.insertBefore(img, heroContent.firstChild);
  }

  // Executa no load e em resize (com debounce leve)
  window.addEventListener('load', injetarFundoCerebro);

  let resizeTimer;
  window.addEventListener('resize', function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function () {
      // Remove se passou para desktop
      if (window.innerWidth >= 992) {
        let bg = document.querySelector('.hero-stats-mobile-bg');
        if (bg) bg.remove();
      } else {
        injetarFundoCerebro();
      }
    }, 150);
  });
})();


const btnContraste = document.getElementById('btn-contraste');

btnContraste.addEventListener('click', () => {
  if (localStorage.getItem('ed-alto-contraste') === 'true') {
    defs.innerHTML =
      '<linearGradient id="ringGrad" x1="0%" y1="0%" x2="100%" y2="100%">' +
      '<stop offset="0%"   stop-color="#fff"/>' +
      '<stop offset="100%" stop-color="#fff"/>' +
      '</linearGradient>';
    svg.prepend(defs);
  }
  else {
    defs.innerHTML =
      '<linearGradient id="ringGrad" x1="0%" y1="0%" x2="100%" y2="100%">' +
      '<stop offset="0%"   stop-color="#00db79"/>' +
      '<stop offset="100%" stop-color="#6effc6"/>' +
      '</linearGradient>';
    svg.prepend(defs);

  }
})
