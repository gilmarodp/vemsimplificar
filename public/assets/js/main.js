$(document).ready(function() {
    $('#content_question').summernote({
        placeholder: 'Copie o enunciado da questão aqui :)',
        tabsize: 2,
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']]
        ],
        callbacks: {
            onChange: function(content, $editable) {
                $('input[name="content_question"]').val(content);
            }
        }
    });
});

$(document).ready(function() {
    $('#resolution_question').summernote({
        placeholder: 'Desenvolva a resolução da questão aqui :)',
        tabsize: 2,
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']]
        ]
        callbacks: {
            onChange: function(content, $editable) {
                $('input[name="resolution_question"]').val(content);
            }
        }
    });
});
