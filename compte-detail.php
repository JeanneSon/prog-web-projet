
<script>
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
                    console.log("check");
                }
            }
        );
    }
    

</script>
<div id="rest">
<h2>Vos données</h2>

<form method="post" action="#" >
<fieldset>
    <legend>Création de compte</legend>

    Login :
    <input type="text" name="login" id="login" />
    <br />
    <div>
        <p style='background-color: red'><span id="loginIndisponible"></span></p>
    </div>

    Mot de passe :
    <input type="text" name="mdp" id="mdp"/>
    <br />

    Nom :
    <input type="text" name="nom" id="nom"/>
    <br />  

    Prénom : 
    <input type="text" name="prenom" id="prenom"/>
    <br />

    Vous êtes :  
    <span id="sexe">
        <input type="radio" name="sexe" value="f" id="femme"/> une femme 	
        <input type="radio" name="sexe" value="h" id="homme"/> un homme
    </span>
    <br />

    Date de naissance
    <input type="date" name="naissance" id="naissance"/>
    <br />

    Adresse électronique : 
    <input type="text"  name="email" id="email"/>
    <br />

    Numéro de téléphone:
    <input type="tel" name="telephone" id="telephone"/>
    <br />

    Adresse: <br />
    <ul>
        <li>Rue:
            <input type="text" name="rue" id="rue"/>
        </li>
    <br />
        <li> Code postal:
            <input type="number" name="codePostal" id="codePostal"/>
        </li>
    <br />
        <li> Ville:
            <input type="text" name="ville" id="ville"/>
        </li>
    <br />
    </ul>
</fieldset>
<br />
    <input type="button" name="button" value="Valider" onclick="validerCompte()"/>
</form>
</div>	