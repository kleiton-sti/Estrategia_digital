tinymce.init({
    selector: '#corpo',
    language: 'pt_BR',
    skin: 'oxide-dark',
    content_css: 'dark',
    height: 450,
    menubar: true,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
        'preview', 'anchor', 'searchreplace', 'visualblocks', 'code',
        'fullscreen', 'insertdatetime', 'media', 'table', 'wordcount'
    ],
    toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code fullscreen',
    images_upload_url: 'https://estrategiadigital.caraguatatuba.sp.gov.br/public/painel/upload/imagem',
    images_upload_credentials: true,
    automatic_uploads: true,
    setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    }
});
