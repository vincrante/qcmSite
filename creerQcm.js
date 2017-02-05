/**
 * Created by Vincent on 05/02/2017.
 */
var index = 1;
var size = $("option").length;
$(document).ready(function(){

    $("#ajouter").click(function () {
        var large ='<tr><td>Question'+index+' :</td><td>'+$("option:selected").text()+'</td><input type="hidden" name="idQuest'+index+'" value="'+$("option:selected").val()+'"></tr>'
        if(index <= size){
            $("#question").append(large),
                index++,
                console.log(index),
                $("#index").val(index-1),
                console.log($("option:selected").val()+" index "+ index+ " size" +size);
                $("option:selected").remove();
        }
    });
});