<?php
	include 'verification_creation.php';
	include 'creation_compte_form.php';
	if(isset($_POST['submit'])){
		if ($ChampsIncorrects !='') {
			echo ' <br /> Merci de remplir correctement les champs ci-dessous :
				<ul> 
					'.$ChampsIncorrects.'
				</ul>';
		}
		else {
			$utilisateurs[$login] = [
				"mdp" => $mdp,
				"nom" => $nom,
				"prenom" => $prenom,
				"sexe" => $sexe,
				"naissance" => $naissance,
				"telephone" => $telephone,
				"email" => $email,
				"rue" => $rue,
				"codePostal" => $codePostal,
				"ville" => $ville,
				"recettes" => array() // stocker les recettes de session
			];
			file_put_contents("DonneesUtilisateurs.json", json_encode($utilisateurs), LOCK_EX);
			$_SESSION["utilisateur"] = $login;
		}
	}
?>
	