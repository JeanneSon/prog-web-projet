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
    if (document.getElementById("coeur_icon").src.endsWith("icons/herz_icon.png")) { // non préféré
        document.getElementById("coeur_icon").src = "icons/coeur_rouge_icon.png";
        document.getElementById("coeur_icon").title = "enlever cette recette de mes recettes préférées";
        modifierPreference(queryString, "ajouter");
    }
    else { // préféré
        document.getElementById("coeur_icon").src = "icons/herz_icon.png";
        document.getElementById("coeur_icon").title = "ajouter cette recette à mes recettes préférées";
        modifierPreference(queryString, "enlever");
    }
}

function modifierPreference(queryString, action) {
    var urlParams = new URLSearchParams(queryString);
    if (urlParams.has('cocktailId')) {
        $.post("modifierPreference.php", { action: action, cocktailId: urlParams.get('cocktailId')}, function(data) {
            console.log(data);
        });
    }
}

// fonctiions du fichier identification_form.php
function compte(){
    window.location.href = "?page=page_creation";
}

function valider() {
    var login = $("input[name='login']").val().trim();
    var mdp = $("input[name='mdp']").val().trim();
    $.post("identification_traitement.php", {login: login, mdp: mdp}, function(data) {
        if (data == "ok") {
            window.location.href = "index.php";
        }
        else {
            $("input[name='login']").val(data);
            $("input[name='login']").css("background-color", "red");
            $("input[name='mdp']").css("background-color", "red");
            $("#erreur").html("Cette combinaison de login et mot de passe n'existe pas.");
        }
    })
}