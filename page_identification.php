<?php
	if (isset($_SESSION['utilisateur'])) { 
		echo "Vous vous êtes déjà connecté!";
		unset($_SESSION['utilisateur']);
		echo "A partir de maintenant, vous n'êtes plus connecté.";
	} else {
		include 'verification_identification.php';
		include 'identification_form.php';
		if(isset($_POST['submit'])){
			if (!$LoginSucces) {
				echo " <br /> Cette combinaison de login et mot de passe n'est pas valide.";

			}
			else {
				$utilisateurs[$trimmedUtilisateur]['recettes'] = array_merge(
					$utilisateurs[$trimmedUtilisateur]['recettes'],
					$_SESSION['MesRecettes']
				);
				file_put_contents("DonneesUtilisateurs.json", json_encode($utilisateurs), LOCK_EX);
				$_SESSION["utilisateur"] = $trimmedUtilisateur;
			}
		}
	}
?>
	