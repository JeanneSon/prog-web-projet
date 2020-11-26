<?php
	include 'verification_identification.php';
	include 'creation_compte.php';
	$utilisateurs = json_decode(file_get_contents("DonneesUtilisateurs.json"), true);
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
				"recettes" => array()
			];
			file_put_contents("DonneesUtilisateurs.json", json_encode($utilisateurs), LOCK_EX);
		}
	}
?>
	