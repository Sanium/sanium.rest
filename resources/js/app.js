require('./bootstrap');

document.addEventListener('DOMContentLoaded', function () {
    M.AutoInit();
    $('.dropdown-trigger').dropdown({
        'alignment': 'right',
        'constrainWidth': false,
        'coverTrigger': false,
    });

    $('#summernote').summernote({
        placeholder: 'Description',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['misc', ['undo', 'redo']],
            ['font', ['bold', 'underline', 'italic', 'clear', 'fontname', 'fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ['view', ['codeview', 'help']]
        ]
    });
});
