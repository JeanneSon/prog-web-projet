<?php
	if (!isset($_SESSION['utilisateur'])) { 
		include 'verification_identification.php';
		include 'identification_form.php';
		if(isset($_POST['submit'])){
			if ($LoginSucces) {
				
				$utilisateurs[$trimmedUtilisateur]['recettes'] = array_merge(
					$utilisateurs[$trimmedUtilisateur]['recettes'],
					$_SESSION['MesRecettes']
				);
				file_put_contents("DonneesUtilisateurs.json", json_encode($utilisateurs), LOCK_EX);
				$_SESSION["utilisateur"] = $trimmedUtilisateur;
				header("Location: index.php");
			}
			else {
				echo " <br /> Cette combinaison de login et mot de passe n'est pas valide.";
			}
		}
	} else {
		include 'modifierUtilisateur.php';
		echo "Vous vous êtes déjà connecté!";
		unset($_SESSION['utilisateur']);
		//echo "A partir de maintenant, vous n'êtes plus connecté.";
		
	}
?>
	