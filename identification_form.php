<div id="rest">
<h2 >Vos données</h2>

<form action="#" method="post">
	<fieldset>
		<div id="compte">
			<legend>Connexion</legend>
			<p id="erreur"></p>

		Login :
			<input type="text" name="login" required="required" />
			<br />

		Mot de passe :
			<input type="text" name="mdp" required="required" />
			<br />

		Pas encore de compte ? Créer vous en un en cliquant ici:
			<input type="button" name="effacer" value="Créer un compte" onclick="redirectCreationCompte()"/>
		</div>
	</fieldset>
	<br />
	<input type="button" name="submit" value="Valider" onclick="valider()"/>
		
</form>	</div>