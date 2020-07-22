let folderInternal = "/vemsimplificar";

let URLBASE = window.location.protocol + "//" + window.location.host + folderInternal;

$(document).ready(function(){
    tinymce.init({
            selector: '#content_question',
            height: 300,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste imagetools wordcount"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code",
            image_adv_tab: true,

            external_filemanager_path: URLBASE + "/public/assets/js/filemanager/",
            filemanager_title: "Responsive Filemanager",
            external_plugins: { "filemanager" : "../filemanager/plugin.min.js" },
            visualblocks_default_state: true,

            style_formats_autohide: true,
            style_formats_merge: true,
            relative_urls : false,
            remove_script_host : false,
            convert_urls : true
    });

    tinymce.init({
            selector: '#resolution_question',
            height: 300,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste imagetools wordcount"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code",
            image_adv_tab: true,

            external_filemanager_path: URLBASE + "/public/assets/js/filemanager/",
            filemanager_title: "Responsive Filemanager",
            external_plugins: { "filemanager" : "../filemanager/plugin.min.js" },
            visualblocks_default_state: true,

            style_formats_autohide: true,
            style_formats_merge: true,
            relative_urls : false,
            remove_script_host : false,
            convert_urls : true
    });
});