$(document).ready(function (){
    $("#name_school").change(function(){
        var name_school = $(this).val();
        if (name_school) {
            $.ajax({
                type: "POST",
                url: "ajax-adicionar-resolucao",
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
                url: "ajax-adicionar-resolucao",
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
                url: "ajax-adicionar-resolucao",
                data: "discipline="+discipline+"&exam_year="+$("#exam_year").val()+"&name_school="+$("#name_school").val(),
                success: function (result){
                    $("#number_question").html(result)
                }
            });
        }
    });
});

