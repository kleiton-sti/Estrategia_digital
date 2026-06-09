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
    automatic_uploads: true,
    images_upload_handler: function (blobInfo, progress) {
        return new Promise(function (resolve, reject) {
            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const uploadUrl = document.querySelector('meta[name="upload-imagem-url"]').getAttribute('content');

            const xhr = new XMLHttpRequest();
            xhr.open('POST', uploadUrl);
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

            xhr.upload.onprogress = function (e) {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const json = JSON.parse(xhr.responseText);
                    resolve(json.link);
                } else {
                    reject({ message: 'Falha no upload: ' + xhr.status, remove: true });
                }
            };

            xhr.onerror = function () {
                reject({ message: 'Erro de rede no upload.', remove: true });
            };

            xhr.send(formData);
        });
    },
    setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    }
});
