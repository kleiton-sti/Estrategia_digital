(function () {
  "use strict";

  /**
   * Adiciona/remover classe .scrolled ao body quando a página é rolada
   */
  function toggleScrolled() {
    const body = document.querySelector('body');
    const header = document.querySelector('#header');
    if (!header) return;

    if (!header.classList.contains('scroll-up-sticky') &&
      !header.classList.contains('sticky-top') &&
      !header.classList.contains('fixed-top')) return;

    window.scrollY > 100 ? body.classList.add('scrolled') : body.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Toggle mobile nav
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function toggleMobileNav() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    if (mobileNavToggleBtn) {
      mobileNavToggleBtn.classList.toggle('bi-list');
      mobileNavToggleBtn.classList.toggle('bi-x');
    }
  }

  if (mobileNavToggleBtn) mobileNavToggleBtn.addEventListener('click', toggleMobileNav);


  // Toggle dropdowns mobile
  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(drop => {
    drop.addEventListener('click', function (e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
    });
  });

  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => preloader.remove());
  }

  /**
   * Scroll top button
   */
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

  /**
   * AOS (animação)
   */
  function aosInit() {
    if (window.AOS) {
      AOS.init({
        duration: 600,
        easing: 'ease-in-out',
        once: true,
        mirror: false
      });
    }
  }
  window.addEventListener('load', aosInit);

  /**
   * PureCounter
   */
  if (window.PureCounter) new PureCounter();

  /**
   * GLightbox
   */
  if (window.GLightbox) {
    GLightbox({ selector: '.glightbox' });
  }

  /**
   * Isotope Layout e Filtros (somente visual)
   */
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

  /**
   * Swiper Sliders
   */
  function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach(swiperEl => {
      let config = JSON.parse(swiperEl.querySelector(".swiper-config").innerHTML.trim());
      new Swiper(swiperEl, config);
    });
  }
  window.addEventListener('load', initSwiper);

  /**
   * Footer coração
   */
  const heart = document.querySelector('.heart-icon');
  if (heart) {
    heart.addEventListener('mouseenter', () => {
      heart.classList.replace('bi-heart', 'bi-heart-fill');
    });
    heart.addEventListener('mouseleave', () => {
      heart.classList.replace('bi-heart-fill', 'bi-heart');
    });
  }

  /**
   * Relayout do Isotope no resize
   */
  window.addEventListener('resize', () => {
    document.querySelectorAll('.isotope-container').forEach(c => {
      if (c._isotope) c._isotope.layout();
    });
  });

  /**
   * Objetivos data show.blade
   */
  document.addEventListener('DOMContentLoaded', () => {
    const objetivosData = window.objetivosData || [];

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
        const div = document.createElement('div');
        const statusClass =
          ini.status === 'Concluída'
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

      container.style.display = 'block';
      container.scrollIntoView({ behavior: 'smooth', block: 'start' });

      const counts = [
        objetivo.iniciativas.length,
        objetivo.iniciativas.filter(i => i.status === 'Concluída').length,
        objetivo.iniciativas.filter(i => i.status === 'Em execução').length,
        objetivo.iniciativas.filter(i => i.status === 'Não iniciada').length
      ];

      document.getElementById('sidebar-total').textContent = counts[0];
      document.getElementById('sidebar-concluidas').textContent = counts[1];
      document.getElementById('sidebar-andamento').textContent = counts[2];
      document.getElementById('sidebar-nao').textContent = counts[3];

      document.querySelectorAll('.objetivo-toggle').forEach(t => {
        t.classList.remove('bi-chevron-up');
        t.classList.add('bi-chevron-down');
      });
      const toggle = card.querySelector('.objetivo-toggle');
      toggle.classList.remove('bi-chevron-down');
      toggle.classList.add('bi-chevron-up');

      // Ajusta a fonte do título das iniciativas no mobile
      const stepTitles = container.querySelectorAll('.process-steps .step-item .step-content h5');
      const isMobile = window.innerWidth <= 768;
      stepTitles.forEach(h5 => {
        h5.style.fontSize = isMobile ? '0.9rem' : '1.2rem';
      });

      if (window.AOS) AOS.refresh();
    }

    function fecharIniciativas() {
      const container = document.querySelector('#principios-details');
      container.style.display = 'none';

      const sectionObjetivos = document.querySelector('#objetivos');
      sectionObjetivos.scrollIntoView({ behavior: 'smooth', block: 'start' });

      document.querySelectorAll('.objetivos-wrapper.selecionado')
        .forEach(el => el.classList.remove('selecionado'));
      document.querySelectorAll('.objetivo-toggle').forEach(t => {
        t.classList.remove('bi-chevron-up');
        t.classList.add('bi-chevron-down');
      });
    }

    document.querySelectorAll('.objetivos-item').forEach(card => {
      card.addEventListener('click', (e) => {
        const objetivoId = Number(card.dataset.objetivoId);
        const objetivo = objetivosData.find(o => o.id === objetivoId);
        if (!objetivo) return;

        const container = document.querySelector('#principios-details');
        const isOpen = container.style.display === 'block' && card.querySelector('.objetivos-wrapper').classList.contains('selecionado');

        if (isOpen) {
          fecharIniciativas();
        } else {
          abrirIniciativas(card, objetivo);
        }
      });
    });

    // Botão Fechar
    const btnFechar = document.getElementById('fechar-iniciativas');
    if (btnFechar) {
      btnFechar.addEventListener('click', fecharIniciativas);
    }

    // Ajusta dinamicamente se o usuário redimensionar a tela
    window.addEventListener('resize', () => {
      const container = document.querySelector('#principios-details');
      if (!container) return;
      const stepTitles = container.querySelectorAll('.process-steps .step-item .step-content h5');
      const isMobile = window.innerWidth <= 768;
      stepTitles.forEach(h5 => {
        h5.style.fontSize = isMobile ? '0.9rem' : '1.2rem';
      });
    });
  });

  /**
 * Mobile dropdown
 */
  const mobileToggle = document.querySelector('.mobile-nav-toggle');
  const navmenu = document.querySelector('.navmenu');

  if (mobileToggle && navmenu) {
    mobileToggle.addEventListener('click', () => {
      navmenu.classList.toggle('mobile-nav-active');
    });
  }

  // Dropdown dentro do menu mobile
  document.querySelectorAll('.navmenu .dropdown > a').forEach(drop => {
    drop.addEventListener('click', function (e) {
      if (window.innerWidth < 1200) {
        e.preventDefault();
        const parent = this.parentElement;
        const submenu = parent.querySelector('ul');

        // Fecha todos os outros dropdowns
        document.querySelectorAll('.navmenu .dropdown ul.dropdown-active').forEach(openSubmenu => {
          if (openSubmenu !== submenu) {
            openSubmenu.classList.remove('dropdown-active');
          }
        });

        // Alterna o dropdown clicado
        submenu.classList.toggle('dropdown-active');
      }
    });
  });

  document.querySelectorAll('.principios-card').forEach(card => {
    card.addEventListener('click', () => {
      const link = card.querySelector('a.principio-btn');
      if (link) {
        window.location.href = link.href;
      }
    });
  });

  /**
   * barra de progresso
   */
  document.addEventListener('DOMContentLoaded', () => {
    const progressBar = document.getElementById('progressBar');
    if (!progressBar) return;

    let target = parseInt(progressBar.dataset.percent, 10) || 0;
    target = Math.max(0, Math.min(target, 100));

    let current = 0;
    const duration = 1200; // tempo da contagem em ms
    const stepTime = 16; // ~60fps
    const totalSteps = duration / stepTime;
    const increment = target / totalSteps;

    // aplica largura via CSS (transição suave)
    requestAnimationFrame(() => {
      progressBar.style.width = target + '%';
    });

    // contador numérico sem travar
    const counter = setInterval(() => {
      current += increment;
      if (current >= target) {
        current = target;
        clearInterval(counter);
      }
      progressBar.textContent = Math.round(current) + '%';
    }, stepTime);
  });

  
})();
