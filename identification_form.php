
<h2 style="position:absolute;left: 20%; top: 15px;font-size:larger;display: inline;">Vos données</h2>

<form action="#" method="post">
	<fieldset>
		<div id="compte">
			<legend>Connexion</legend>
			<p id="erreur"></p>

		Login :
			<input type="text" name="login" <?php if($ClassLogin=='error'){echo "style ='background-color: red'";}?> required="required" 
			value="<?php if(isset($_POST['login']))  echo $_POST['login']; ?>"/>
			<br />

		Mot de passe :
			<input type="text" name="mdp" <?php if($ClassMdp=='error'){echo "style ='background-color: red'";}?> required="required" 
			value="<?php if(isset($_POST['mdp']))  echo $_POST['mdp']; ?>"/>
			<br />

		Pas encore de compte ? Créer vous en un en cliquant ici:
			<input type="button" name="effacer" value="Créer un compte" onclick="compte()"/>
		</div>
	</fieldset>
	<br />
	<input type="button" name="submit" value="Valider" onclick="valider()"/>
		
</form>	