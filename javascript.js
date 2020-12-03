// fonctions de la page recherche-saisie.php
$(document).ready(function() {
    $.get("getIngredients.php", { type: "all"}, function(data) {
        var ingredients = data.split(",");
        $("#automplete-1").autocomplete({
            source: ingredients,
            minLength: 1,
            delay: 500,
            autoFocus: true
        });
        $("#automplete-2").autocomplete({
            source: ingredients,
            minLength: 1,
            delay: 500,
            autoFocus: true
        });
    })    
});






$(document).ready(function() {
    $("#login").blur(function() {
        $.get("loginDisponible.php?login="+$("#login").val(),
            function(data) {
                $("#loginIndisponible").html(data);
            }
        );
    })
});


//fonctions du fichier cocktail-detail.php
function preferer(queryString) {
    // non préféré au début
    if (document.getElementById("coeur_icon").src.endsWith("icons/herz_icon.png")) { 
        document.getElementById("coeur_icon").src = "icons/coeur_rouge_icon.png";
        document.getElementById("coeur_icon").title = "enlever cette recette de mes recettes préférées";
        modifierPreference(queryString, "ajouter");
    }
    // préféré
    else { 
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



// fonctions du fichier identification_form.php
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