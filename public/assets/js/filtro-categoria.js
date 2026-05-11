/* Filtro por categoria */
document.querySelectorAll('.btn-pill').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.btn-pill').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const cat = this.dataset.categoria;

        document.querySelectorAll('#grid-artigos [data-categoria]').forEach(card => {
            card.style.display = (cat === 'todos' || card.dataset.categoria === cat) ? '' : 'none';
        });
    });
});