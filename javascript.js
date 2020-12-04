$(function(){
    // checker si l'utilisateur est connecté
    $.post("gestionUtilisateur.php", {connecte: ""}, function(data) {
        if (data != "non connecté") {
            var champs = data.split(";;;");
            champs.forEach(element => {
                var [champ, valeur] = element.split("...");
                if (champ == "sexe") {
                    if (valeur == "f") {
                        document.getElementById("femme").checked = true;
                    } else if (valeur == "h") {
                        document.getElementById("homme").checked = true;
                    }
                }
                var identifiant = "#" + champ;
                $(identifiant).val(valeur);
            });
        }
    });
});


// fonctions de la page recherche-saisie.php
$(document).ready(function() {
    $.get("getIngredients.php", { type: "all"}, function(data) {
        var ingredients = data.split(",");
        $("#autocomplete-1").autocomplete({
            source: ingredients,
            minLength: 1,
            delay: 500,
            autoFocus: true
        });
        $("#autocomplete-2").autocomplete({
            source: ingredients,
            minLength: 1,
            delay: 500,
            autoFocus: true
        });
        $("#autocomplete-3").autocomplete({
            source: ingredients,
            minLength: 1,
            delay: 500,
            autoFocus: true
        });
    })    
});






$(document).ready(function() {
    $.post("gestionUtilisateur.php", {connecte: ""}, function(data) {
        if (data == "non connecté") {
            $("#login").blur(function() {
                $.get("gestionUtilisateur.php?login="+$("#login").val(),
                    function(data) {
                        $("#loginIndisponible").html(data);
                    }
                );
            })
        }
    });
    
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
        $.post("modifierPreference.php", { action: action, cocktailId: urlParams.get('cocktailId')});
    }
}



// fonctions du fichier identification_form.php
function redirectCreationCompte(){
    window.location.href = "?page=compte-detail";
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

// fonctions du fichier cocktail-detail
function validerCompte(){
    var sexe = "notSet";
    if (document.getElementById("femme").checked) {
        sexe = $("#femme").val();
    } else if (document.getElementById("homme").checked) {
        sexe = $("#homme").val();
    }
    console.log(sexe);
    $.post("verification_compte.php", { 
            login: $("#login").val(),
            mdp: $("#mdp").val(),
            nom: $("#nom").val(),
            prenom: $("#prenom").val(),
            sexe: sexe,
            naissance: $("#naissance").val(),
            email: $("#email").val(),
            telephone: $("#telephone").val(),
            rue: $("#rue").val(),
            codePostal: $("#codePostal").val(),
            ville: $("#ville").val()
        }, function(data) {
            console.log(data);
            if (data == "ok") {
                //modifier
                alert("Modification prise en compte !");
                window.location.href = "index.php";
            } else {
                var fauxChamps = data.split(";;;");
                fauxChamps.forEach(champ => {
                    var identifiant = "#" + champ;
                    $(identifiant).css("background-color", "red");
                });
            }
        }
    );
}