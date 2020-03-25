require('./bootstrap');

document.addEventListener('DOMContentLoaded', function () {
    M.AutoInit();
    $('.dropdown-trigger').dropdown({
        'alignment': 'right',
        'constrainWidth': false,
        'coverTrigger': false,
    });
    $('select').formSelect('', {
        'constrainWidth': true,
        'coverTrigger': false,
    });

    // summernote config
    const summernote_config = {
        tabsize: 2,
        height: 360,
        disableDragAndDrop: true,
        tabDisable: true,
        toolbar: [
            ['style', ['style']],
            ['misc', ['undo', 'redo']],
            ['font', ['bold', 'underline', 'italic', 'clear', 'fontname', 'fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ['view', ['codeview', 'help']]
        ],
    };

    $('.summernote').each((i, e) => {
        let $e = $(e);
        const placeholder = $e.attr('placeholder');
        let element_config = { placeholder };
        Object.assign(element_config, summernote_config);
        $e.summernote(element_config);
    });
});
