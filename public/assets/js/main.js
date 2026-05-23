(function () {
  "use strict";

  function toggleScrolled() {
    const body   = document.querySelector('body');
    const header = document.querySelector('#header');
    if (!header) return;
    if (!header.classList.contains('scroll-up-sticky') &&
      !header.classList.contains('sticky-top') &&
      !header.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? body.classList.add('scrolled') : body.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function toggleMobileNav() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    if (mobileNavToggleBtn) {
      mobileNavToggleBtn.classList.toggle('bi-list');
      mobileNavToggleBtn.classList.toggle('bi-x');
    }
  }

  if (mobileNavToggleBtn) mobileNavToggleBtn.addEventListener('click', toggleMobileNav);

  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(drop => {
    drop.addEventListener('click', function (e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
    });
  });

  const preloader = document.querySelector('#preloader');
  if (preloader) window.addEventListener('load', () => preloader.remove());

  const scrollTop = document.querySelector('.scroll-top');
  function toggleScrollTop() {
    if (!scrollTop) return;
    window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
  }
  if (scrollTop) {
    scrollTop.addEventListener('click', e => {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }
  window.addEventListener('scroll', toggleScrollTop);
  window.addEventListener('load', toggleScrollTop);

  function aosInit() {
    if (window.AOS) AOS.init({ duration: 600, easing: 'ease-in-out', once: true, mirror: false });
  }
  window.addEventListener('load', aosInit);

  if (window.PureCounter) new PureCounter();
  if (window.GLightbox) GLightbox({ selector: '.glightbox' });

  document.querySelectorAll('.isotope-layout').forEach(container => {
    let isoContainer = container.querySelector('.isotope-container');
    if (!isoContainer) return;
    let initIsotope = null;
    if (window.imagesLoaded && window.Isotope) {
      imagesLoaded(isoContainer, () => {
        initIsotope = new Isotope(isoContainer, {
          itemSelector: '.isotope-item',
          layoutMode: container.dataset.layout || 'masonry',
          filter: container.dataset.defaultFilter || '*',
        });
      });
    }
    container.querySelectorAll('.isotope-filters li').forEach(filterBtn => {
      filterBtn.addEventListener('click', () => {
        container.querySelector('.filter-active')?.classList.remove('filter-active');
        filterBtn.classList.add('filter-active');
        if (initIsotope) initIsotope.arrange({ filter: filterBtn.dataset.filter });
        if (window.AOS && typeof AOS.refresh === 'function') AOS.refresh();
      });
    });
  });

  function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach(swiperEl => {
      let config = JSON.parse(swiperEl.querySelector(".swiper-config").innerHTML.trim());
      new Swiper(swiperEl, config);
    });
  }
  window.addEventListener('load', initSwiper);

  const heart = document.querySelector('.heart-icon');
  if (heart) {
    heart.addEventListener('mouseenter', () => heart.classList.replace('bi-heart', 'bi-heart-fill'));
    heart.addEventListener('mouseleave', () => heart.classList.replace('bi-heart-fill', 'bi-heart'));
  }

  window.addEventListener('resize', () => {
    document.querySelectorAll('.isotope-container').forEach(c => {
      if (c._isotope) c._isotope.layout();
    });
  });

  /* ── Objetivos / Iniciativas ── */
  document.addEventListener('DOMContentLoaded', () => {
    const objetivosData = window.objetivosData || [];

    function atualizarLegendaConcluidas(concluidas, total) {
      const el = document.getElementById('ini-legenda-concluidas');
      if (el) el.textContent = 'de ' + total + ' iniciativas entregues';
    }

    function abrirIniciativas(card, objetivo) {
      document.querySelectorAll('.objetivos-wrapper.selecionado')
        .forEach(el => el.classList.remove('selecionado'));

      const wrap = card.querySelector('.objetivos-wrapper');
      if (wrap) wrap.classList.add('selecionado');

      const container = document.querySelector('#principios-details');
      if (!container) return;

      const steps = container.querySelector('.process-steps');
      steps.innerHTML = '';

      objetivo.iniciativas.forEach(ini => {
        const div         = document.createElement('div');
        const statusClass = ini.status === 'Concluída'
          ? 'bg-success'
          : ini.status === 'Em execução'
            ? 'bg-primary'
            : 'bg-danger';

        div.className = 'step-item';
        div.innerHTML = `
          <div class="step-number rounded-circle ${statusClass}"></div>
          <div class="step-content ms-3">
            <h5 class="mb-1">${ini.titulo}</h5>
          </div>
        `;
        steps.appendChild(div);
      });

      container.classList.remove('is-hidden');
      container.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

      const total      = objetivo.iniciativas.length;
      const concluidas = objetivo.iniciativas.filter(i => i.status === 'Concluída').length;
      const andamento  = objetivo.iniciativas.filter(i => i.status === 'Em execução').length;
      const nao        = objetivo.iniciativas.filter(i => i.status === 'Não iniciada').length;

      document.getElementById('sidebar-total').textContent      = total;
      document.getElementById('sidebar-concluidas').textContent = concluidas;
      document.getElementById('sidebar-andamento').textContent  = andamento;
      document.getElementById('sidebar-nao').textContent        = nao;

      if (window.atualizarAnel) window.atualizarAnel(concluidas, total);
      atualizarLegendaConcluidas(concluidas, total);

      document.querySelectorAll('.objetivo-toggle').forEach(t => {
        t.classList.remove('bi-chevron-up');
        t.classList.add('bi-chevron-down');
      });
      const toggle = card.querySelector('.objetivo-toggle');
      toggle.classList.remove('bi-chevron-down');
      toggle.classList.add('bi-chevron-up');

      if (window.AOS) AOS.refresh();
    }

    function fecharIniciativas() {
      const container = document.querySelector('#principios-details');
      container.classList.add('is-hidden');
      document.querySelector('#objetivos')
        .scrollIntoView({ behavior: 'smooth', block: 'start' });
      document.querySelectorAll('.objetivos-wrapper.selecionado')
        .forEach(el => el.classList.remove('selecionado'));
      document.querySelectorAll('.objetivo-toggle').forEach(t => {
        t.classList.remove('bi-chevron-up');
        t.classList.add('bi-chevron-down');
      });
    }

    document.querySelectorAll('.objetivos-item').forEach(card => {
      card.addEventListener('click', () => {
        const objetivoId = Number(card.dataset.objetivoId);
        const objetivo   = objetivosData.find(o => o.id === objetivoId);
        if (!objetivo) return;

        const container = document.querySelector('#principios-details');
        const isOpen    = container.style.display === 'block'
          && card.querySelector('.objetivos-wrapper').classList.contains('selecionado');

        isOpen ? fecharIniciativas() : abrirIniciativas(card, objetivo);
      });
    });

    const btnFechar = document.getElementById('fechar-iniciativas');
    if (btnFechar) btnFechar.addEventListener('click', fecharIniciativas);
  });

  /* ── Mobile dropdown ── */
  document.querySelectorAll('.navmenu .dropdown > a').forEach(drop => {
    drop.addEventListener('click', function (e) {
      if (window.innerWidth < 1200) {
        e.preventDefault();
        const submenu = this.parentElement.querySelector('ul');
        document.querySelectorAll('.navmenu .dropdown ul.dropdown-active').forEach(open => {
          if (open !== submenu) open.classList.remove('dropdown-active');
        });
        submenu.classList.toggle('dropdown-active');
      }
    });
  });

  /* —— Eixo-portais (home) —— */
  (function () {
    document.querySelectorAll('.eixo-portal__stars').forEach(el => {
      for (let i = 0; i < 18; i++) {
        const s = document.createElement('span');
        s.style.cssText = [
          'position:absolute',
          `top:${Math.random() * 100}%`,
          `left:${Math.random() * 100}%`,
          `width:${Math.random() * 1.5 + 0.5}px`,
          `height:${Math.random() * 1.5 + 0.5}px`,
          'border-radius:50%',
          'background:#fff',
          `opacity:${(Math.random() * 0.3 + 0.05).toFixed(2)}`,
        ].join(';');
        el.appendChild(s);
      }
    });

    let eixoAtivoId = null;

    function fecharEixoInline(id) {
      const inline = document.getElementById('eixo-inline-' + id);
      if (inline) inline.classList.add('is-hidden');
      const portal = document.querySelector('.eixo-portal[data-eixo-id="' + id + '"]');
      if (portal) portal.classList.remove('ativo');
      eixoAtivoId = null;
    }

    function abrirEixoInline(eixoId) {
      if (eixoAtivoId && eixoAtivoId !== eixoId) fecharEixoInline(eixoAtivoId);

      const inline = document.getElementById('eixo-inline-' + eixoId);
      if (!inline) return;

      if (eixoAtivoId === eixoId) { fecharEixoInline(eixoId); return; }

      inline.classList.remove('is-hidden');
      eixoAtivoId = eixoId;

      const portal = document.querySelector('.eixo-portal[data-eixo-id="' + eixoId + '"]');
      if (portal) portal.classList.add('ativo');

      /* anima as constelações do eixo-inline recém aberto */
      if (window.carregarConstelacao) window.carregarConstelacao(inline);

      const objetivosData = JSON.parse(inline.dataset.objetivos || '[]');
      const detailsEl    = document.getElementById('principios-details-' + eixoId);

      inline.querySelectorAll('.objetivos-item').forEach(card => {
        if (card.dataset.listenerAtivo) return;
        card.dataset.listenerAtivo = '1';

        card.addEventListener('click', () => {
          const oId     = Number(card.dataset.objetivoId);
          const objetivo = objetivosData.find(o => o.id === oId);
          if (!objetivo || !detailsEl) return;

          const wrap = card.querySelector('.objetivos-wrapper');
          const jaSelecionado = wrap && wrap.classList.contains('selecionado');

          inline.querySelectorAll('.objetivos-wrapper.selecionado')
            .forEach(el => el.classList.remove('selecionado'));
          inline.querySelectorAll('.objetivo-toggle').forEach(t => {
            t.classList.remove('bi-chevron-up');
            t.classList.add('bi-chevron-down');
          });

          if (jaSelecionado) {
            detailsEl.classList.add('is-hidden');
            return;
          }

          if (wrap) wrap.classList.add('selecionado');
          const toggle = card.querySelector('.objetivo-toggle');
          if (toggle) { toggle.classList.remove('bi-chevron-down'); toggle.classList.add('bi-chevron-up'); }

          const steps = detailsEl.querySelector('.process-steps');
          if (steps) {
            steps.innerHTML = '';
            objetivo.iniciativas.forEach(ini => {
              const statusClass = ini.status === 'Concluída' ? 'bg-success'
                : ini.status === 'Em execução'           ? 'bg-primary'
                :                                               'bg-danger';
              const div = document.createElement('div');
              div.className = 'step-item';
              div.innerHTML = `
                <div class="step-number rounded-circle ${statusClass}"></div>
                <div class="step-content ms-3"><h5 class="mb-1">${ini.titulo}</h5></div>
              `;
              steps.appendChild(div);
            });
          }

          const total      = objetivo.iniciativas.length;
          const concluidas = objetivo.iniciativas.filter(i => i.status === 'Concluída').length;
          const andamento  = objetivo.iniciativas.filter(i => i.status === 'Em execução').length;
          const nao        = objetivo.iniciativas.filter(i => i.status !== 'Concluída' && i.status !== 'Em execução').length;

          const q = s => detailsEl.querySelector(s);
          if (q('[data-sidebar-total]'))      q('[data-sidebar-total]').textContent      = total;
          if (q('[data-sidebar-concluidas]')) q('[data-sidebar-concluidas]').textContent = concluidas;
          if (q('[data-sidebar-andamento]'))  q('[data-sidebar-andamento]').textContent  = andamento;
          if (q('[data-sidebar-nao]'))        q('[data-sidebar-nao]').textContent        = nao;
          if (q('[data-legenda-concluidas]')) q('[data-legenda-concluidas]').textContent = 'de ' + total + ' iniciativas entregues';

          const circulo = q('[data-anel-circulo]');
          if (circulo) {
            const raio = 26, circ = 2 * Math.PI * raio;
            const pct  = total > 0 ? concluidas / total : 0;
            circulo.style.strokeDasharray  = circ;
            circulo.style.strokeDashoffset = circ * (1 - pct);
          }

          detailsEl.classList.remove('is-hidden');
          detailsEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });
      });

      setTimeout(() => inline.scrollIntoView({ behavior: 'smooth', block: 'start' }), 60);
    }

    document.querySelectorAll('.eixo-portal').forEach(portal => {
      portal.addEventListener('click', () => {
        const id = Number(portal.dataset.eixoId);
        abrirEixoInline(id);
      });
    });

    document.querySelectorAll('[data-fechar-eixo]').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = Number(btn.dataset.fecharEixo);
        fecharEixoInline(id);
        const sec = document.getElementById('principios');
        if (sec) sec.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    });
  })();

  /* ── Barra de progresso ── */
  document.addEventListener('DOMContentLoaded', () => {
    const progressBar = document.getElementById('progressBar');
    if (!progressBar) return;

    let target = parseInt(progressBar.dataset.percent, 10) || 0;
    target = Math.max(0, Math.min(target, 100));

    let current       = 0;
    const duration    = 1200;
    const stepTime    = 16;
    const totalSteps  = duration / stepTime;
    const increment   = target / totalSteps;

    requestAnimationFrame(() => { progressBar.style.width = target + '%'; });

    const counter = setInterval(() => {
      current += increment;
      if (current >= target) { current = target; clearInterval(counter); }
      progressBar.textContent = Math.round(current) + '%';
    }, stepTime);
  });

})();
