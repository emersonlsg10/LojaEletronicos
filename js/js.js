$(function(){
    $("#btnfrete").click(function(){
        $.ajax({
            url: "calculofrete.php",
            type: "post",
            success: function(data){
                $("#valorfrete").html("R$" + data);
            }
        })
    })	
});