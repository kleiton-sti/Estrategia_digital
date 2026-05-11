document.addEventListener('DOMContentLoaded', function () {

    var pills = document.querySelectorAll('#filtro-categorias .btn-pill');
    var colunas = document.querySelectorAll('#grid-artigos .artigo-col');

    pills.forEach(function (btn) {
        btn.addEventListener('click', function () {
            pills.forEach(function (b) { b.classList.remove('active'); });
            this.classList.add('active');

            var cat = this.dataset.categoria;

            colunas.forEach(function (col) {
                if (cat === 'todos') {
                    col.style.display = '';
                    return;
                }

                var slugs = (col.dataset.categorias || '').split(' ').filter(Boolean);
                col.style.display = slugs.indexOf(cat) !== -1 ? '' : 'none';
            });
        });
    });

});
