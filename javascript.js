$(document).ready(function() {
    $("#login").blur(function() {
        $.get("checkLogin.php?login="+$("#login").val(),
            function(data) {
                $("#loginIndisponible").html(data);
            }
        );
    })
});