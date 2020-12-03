<h1>Vos données</h1>

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
    <input type="text" name="mdp" />
    <br />

    Nom :
    <input type="text" name="nom" />
    <br />  

    Prénom : 
    <input type="text" name="prenom" />
    <br />

    Vous êtes :  
    <span>
        <input type="radio" name="sexe" value="f"/> une femme 	
        <input type="radio" name="sexe" value="h"/> un homme
    </span>
    <br />

    Date de naissance
    <input type="date" name="naissance"/>
    <br />

    Adresse électronique : 
    <input type="text"  name="email"/>
    <br />

    Numéro de téléphone:
    <input type="tel" name="telephone" />
    <br />

    Adresse: <br />
    <ul>
        <li>Rue:
            <input type="text" name="rue" />
        </li>
    <br />
        <li> Code postal:
            <input type="number" name="codePostal" />
        </li>
    <br />
        <li> Ville:
            <input type="text" name="ville" />
        </li>
    <br />
    </ul>
</fieldset>
<br />
    <input type="submit" name="submit" value="Valider" onclick=""/>
</form>	