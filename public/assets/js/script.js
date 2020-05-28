const URLPAGE = "https://www.vemsimplificar.com.br";

function trim(str) {
	return str.replace(/^\s+|\s+$/g,"");
}

function validateQuestion(id1, id2) {
    var content1 = trim(document.getElementById(id1).textContent);
    var content2 = trim(document.getElementById(id2).textContent);

    if (content1 === "" || content2 === "") {
        window.alert('A resolução dessa questão ainda não está pronta, se tiver dúvidas, entre em contato conosco atráves do e-mail ou atráves do Discord.');
        location.href = URLPAGE + "/materiais/resolucoes/2020-1";
    }
}

tinymce.init({
            selector: 'textarea',
            plugins: 'advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed link powerpaste table advtable tinymcespellchecker imagetools image preview',
            toolbar: 'addcomment showcomments casechange checklist code formatpainter pageembed table | alignjustify alignleft aligncenter alignright | link image preview | bullist numlist',
            toolbar_mode: 'floating',
            advlist_number_styles: "lower-alpha",
            // enable title field in the Image dialog
            image_title: true, 
            // enable automatic uploads of images represented by blob or data URIs
            automatic_uploads: true,
            // add custom filepicker only to Image dialog
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function() {
                var file = this.files[0];
                var reader = new FileReader();
                
                reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    // call the callback and populate the Title field with the file name
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
                };
                
                input.click();
            }
        });

