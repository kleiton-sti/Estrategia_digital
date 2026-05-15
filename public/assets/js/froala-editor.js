new FroalaEditor('#corpo', {
    language: 'pt_br',
    heightMin: 350,
    imageUploadURL: 'https://estrategiadigital.caraguatatuba.sp.gov.br/public/painel/upload/imagem',
    imageUploadMethod: 'POST',

    requestHeaders: {
        'X-CSRF-TOKEN': document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content')
    },

    toolbarButtons: {
        moreText: {
            buttons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript',
                'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'clearFormatting']
        },
        moreParagraph: {
            buttons: ['alignLeft', 'alignCenter', 'alignRight', 'alignJustify',
                'formatOL', 'formatUL', 'paragraphFormat', 'lineHeight', 'outdent', 'indent', 'quote']
        },
        moreRich: {
            buttons: ['insertLink', 'insertImage', 'insertTable', 'emoticons', 'specialCharacters', 'insertHR']
        },
        moreMisc: {
            buttons: ['undo', 'redo', 'fullscreen', 'print', 'getPDF', 'selectAll', 'html', 'help']
        }
    },
    pluginsEnabled: ['align', 'charCounter', 'codeBeautifier', 'codeView', 'colors', 'draggable',
        'emoticons', 'entities', 'file', 'fontFamily', 'fontSize', 'fullscreen',
        'image', 'inlineStyle', 'lineBreaker', 'link', 'lists', 'paragraphFormat',
        'paragraphStyle', 'print', 'quote', 'save', 'specialCharacters', 'table',
        'url', 'video', 'wordPaste']
});