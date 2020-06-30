$(document).ready(function (){
    $("#name_school").change(function(){
        var name_school = $(this).val();
        if (name_school) {
            $.ajax({
                type: "POST",
                url: "ajax-editar-resolucao",
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
                url: "ajax-editar-resolucao",
                data: "exam_year="+exam_year+"&name_school="+$("#name_school").val(),
                success: function(result){
                    $("#discipline").html(result);
                }
            });
        }
    });
    $("#discipline").change(function (){
        var discipline = $(this).val();
        if (discipline) {
            $.ajax({
                type: "POST",
                url: "ajax-editar-resolucao",
                data: "discipline="+discipline+"&exam_year="+$("#exam_year").val()+"&name_school="+$("#name_school").val(),
                success: function (result){
                    $("#number_question").html(result);
                }
            });
        }
    });
    $("#number_question").change(function (){
        var number_question = $(this).val();
        if (number_question) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "ajax-editar-resolucao",
                data: "number_question="+number_question+"&author="+$("#author").val()+"&discipline="+$("#discipline").val()+"&exam_year="+$("#exam_year").val()+"&name_school="+$("#name_school").val(),
                success: function (result){
                    tinyMCE.get('content_question').setContent(result.content_question);
                    tinyMCE.get('resolution_question').setContent(result.resolution_question);
                    //$("#content_question").html(result.content_question);
                    //$("#resolution_question").html(result.content_question);
                }
            });
        }
    });
});

