const URLPAGE = "https://www.vemsimplificar.com.br/";

function trim(str) {
	return str.replace(/^\s+|\s+$/g,"");
}

$(document).ready(function (){
    $("#name_school").change(function(){
        var name_school = $(this).val();
        if (name_school) {
            $.ajax({
                type: "POST",
                url: "ajax-data",
                data: "name_school="+name_school,
                success: function(result){
                    $("#exam_year").html(result);
                }
            });
        }
    });
    $("#exam_year").change(function (){
        var exam_year = $(this).val();
        if (exam_year) {
            $.ajax({
                type: "POST",
                url: "ajax-data",
                data: "exam_year="+exam_year+"&name_school="+$("#name_school").val(),
                success: function(result){
                    $("#discipline").html(result)
                }
            });
        }
    });
    $("#discipline").change(function (){
        var discipline = $(this).val();
        if (discipline) {
            $.ajax({
                type: "POST",
                url: "ajax-data",
                data: "discipline="+discipline+"&exam_year="+$("#exam_year").val()+"&name_school="+$("#name_school").val(),
                success: function (result){
                    $("#number_question").html(result)
                }
            });
        }
    });
});


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

