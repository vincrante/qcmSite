/**
 * Created by vincent on 10/01/17.
 */
var index = 3
$(document).ready(function(){
    $("#more").click(function () {
        var large ='<tr><td>Réponse '+index+' : <input type="text" name = "reponse'+index+'"></td><td>Vrai ? : <input type="checkbox" name="check'+index+'"></td><td>FeedBack : <input type="text" name="feedback'+index+'" ></td></tr>'
        $("#reponse").append(large),
        index++,
         $("#index").val(index-1),
        console.log(index)
    });
    $("#less").click(function () {
        if(index > 3) {
            $("#reponse tr:last").remove(),
                index--,
                $("#index").val(index - 1),
                console.log(index)
        }
    });
});