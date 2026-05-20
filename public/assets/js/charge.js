// Immediately invoked function usada para executar imediatamente após carregamendo dom DOM e isolar 
// variáveis e funcções do escopo global.
(function () {
    let ring = document.getElementById('ringProgress'); // nó interno ao SVG
    if (!ring) return;

    let TOTAL         = 81;
    let CIRCUMFERENCE = 326.7; // representa comprimento da circunferência (2 * π * raio), raio = 52.

    let svg  = ring.closest('svg'); // Pega ancestral mais próximo, nesse caso o SVG

    // Criar elemento em SVG 
    let defs = document.createElementNS('http://www.w3.org/2000/svg', 'defs');
    defs.innerHTML =
        '<linearGradient id="ringGrad" x1="0%" y1="0%" x2="100%" y2="100%">' +
            '<stop offset="0%"   stop-color="#00db79"/>' +
            '<stop offset="100%" stop-color="#6effc6"/>' +
        '</linearGradient>';
    svg.prepend(defs); //adiciona no topo do SVG
    
    // Controla o padrão do traço, nesse caso o traço tem o tamanho da circunferência
    ring.style.strokeDasharray  = CIRCUMFERENCE;

    // Controla a posição inicial do traço (começa oculto)
    ring.style.strokeDashoffset = CIRCUMFERENCE;

    function setProgress(value) {
        let pct    = Math.min(value / TOTAL, 1);  // com o '1' o valor nunca passa de 100%
        let offset = CIRCUMFERENCE * (1 - pct);
        ring.style.strokeDashoffset = offset; // determina o quanto do traço deve ficar escondido
    }

    let statEl = document.querySelector('.ring-inner .ist-num--verde'); // pega os numeros do dom
    if (!statEl) return;

    // o MutationObserver observa mudanças no DOM em tempo real
    let observer = new MutationObserver(function () {
        let v = parseInt(statEl.textContent, 10) || 0;
        setProgress(v);
    });

    // observa o statEl e todos elementos internos: nós filhos, mudancas de texto e demais elementos internos
    observer.observe(statEl, { childList: true, characterData: true, subtree: true });

    // no carregamento da página ele já verifica o valor, colocando na base 10
    let initial = parseInt(statEl.textContent, 10) || 0;
    if (initial > 0) setProgress(initial);
})();
