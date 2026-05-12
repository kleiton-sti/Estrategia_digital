// document.addEventListener('DOMContentLoaded', function () {

//     let pills = document.querySelectorAll('#filtro-categorias .btn-pill');
//     let colunas = document.querySelectorAll('#grid-artigos .artigo-col');

//     pills.forEach(function (btn) {
//         btn.addEventListener('click', function () {
//             pills.forEach(function (b) { b.classList.remove('active'); });
//             this.classList.add('active');

//             let cat = this.dataset.categoria;
            
//             // para garantir que todos serão vistos
//             colunas.forEach(function (col) {
//                 if (cat === 'todos') {
//                     col.style.display = '';
//                     return;
//                 }

//                 let slugs = (col.dataset.categorias || '').split(' ').filter(Boolean);
//                 col.style.display = slugs.indexOf(cat) !== -1 ? '' : 'none';
//             });
//         });
//     });

// });
