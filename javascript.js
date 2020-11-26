$(document).ready(function() {
    $("#login").blur(function() {
        $.get("checkLogin.php?login="+$("#login").val(),
            function(data) {
                $("#loginIndisponible").html(data);
            }
        );
    })
});

function preferer(queryString) {
    if (document.getElementById("coeur_icon").src.endsWith("icons/herz_icon.png")) {
        document.getElementById("coeur_icon").src = "icons/coeur_rouge_icon.png";
        document.getElementById("coeur_icon").title = "enlever cette recette de mes recettes préférées";
        modifierPreference(queryString, "ajouter");
    }
    else {
        document.getElementById("coeur_icon").src = "icons/herz_icon.png";
        document.getElementById("coeur_icon").title = "ajouter cette recette à mes recettes préférées";
        modifierPreference(queryString, "enlever");
    }
}

function modifierPreference(queryString, action) {
    var urlParams = new URLSearchParams(queryString);
    if (urlParams.has('cocktailId')) {
        $.post("modifierPreference.php", { action: action, cocktailId: urlParams.get('cocktailId')});
    }
}
