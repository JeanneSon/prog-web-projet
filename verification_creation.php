<?php

$ClassLogin = 'ok';
$ClassMdp = 'ok';
$ClassNom = 'ok';
$ClassPrenom = 'ok';
$ClassSexe = 'ok';
$ClassNaissance = 'ok';
$ClassTelephone = 'ok';
$ClassEmail = 'ok';
$ClassRue = 'ok';
$ClassCodePostal = 'ok';
$ClassVille = 'ok';

$ChampsIncorrects = [];


$login = "";
$mdp = "";
$nom = "";
$prenom = "";
$sexe = "";
$naissance = "";
$email = "";
$telephone = "";
$rue = "";
$codePostal = "";
$ville = "";


if (isset($_POST['submit'])) {
	$ChampsIncorrects['Login'] = 'Login';
	$ClassLogin = 'error';
	if (isset($_POST['login'])) {
		$trimmedLogin = trim($_POST['login']);
		if (strlen($trimmedLogin) > 1) {
			unset($ChampsIncorrects['Login']);
			$ClassLogin = 'ok';
			$login = $trimmedLogin;
		}
	}

	$ChampsIncorrects['Mot de passe'] = 'Mot de passe';
	$ClassMdp = 'error';
	if (isset($_POST['mdp'])) {
		$trimmedMdp = trim($_POST['mdp']);
		if (strlen($trimmedMdp) > 1) {
			$ClassMdp = "ok";
			unset($ChampsIncorrects['Mot de passe']);
			$mdp = $trimmedMdp;
		}
	}

	if (isset($_POST['nom'])) {
		$trimmedNom = trim($_POST['nom']);
		if (strlen($trimmedNom) == 1) {
			$ChampsIncorrects['Nom'] = 'Nom';
			$ClassNom = 'error';
		} else if (strlen($trimmedNom) > 1) {
			$nom = $trimmedNom;
		}
	}


	if (isset($_POST['prenom'])) {
		$trimmedPrenom = trim($_POST['prenom']);
		if (strlen($trimmedPrenom) == 1) {
			$ChampsIncorrects['Prénom'] = 'Prénom';
			$ClassPrenom = 'error';
		} else if (strlen($trimmedPrenom) > 1) {
			$prenom = $trimmedPrenom;
		}
	}


	if (isset($_POST['sexe'])) {
		$trimmedSexe = trim($_POST['sexe']);
		if ($trimmedSexe == "f" || $trimmedSexe == "h") {
			$sexe = $trimmedSexe;
		} else {
			$ChampsIncorrects['Sexe'] = 'Sexe';
			$ClassSexe = 'error';
		}
	}

	if (isset($_POST['naissance'])) {
		$trimmedNaissance = trim($_POST['naissance']);
		if ($trimmedNaissance != "") {
			list($Annee, $Mois, $Jour) = explode('-', $trimmedNaissance);
			if (!checkdate($Mois, $Jour, $Annee)) {
				$ChampsIncorrects['Date de naissance'] = 'Date de naissance';
				$ClassNaissance = 'error';
			} else $naissance = $trimmedNaissance;
		} 
	}

	if (isset($_POST['email'])) {
		$trimmedEmail = trim($_POST['email']);
		if (filter_var($trimmedEmail, FILTER_VALIDATE_EMAIL)) {
			$email = $trimmedEmail;
		} else if ($trimmedEmail != "") {
			$ChampsIncorrects['Adresse électronique'] = 'Adresse électronique';
			$ClassEmail = 'error';
		}
	}
	
	if (isset($_POST['telephone'])) {
		$trimmedTelephone = trim($_POST['telephone']);
		if (preg_match("#([0-9]{2}){5}#", $trimmedTelephone)) {
			$telephone = $trimmedTelephone;
		}
		else {
			$ChampsIncorrects['Numéro de telephone'] = 'Numéro de telephone';
			$ClassTelephone = 'error';
		}
	}

	if (isset($_POST['rue'])) {
		$trimmedRue = trim($_POST['rue']);
		if (strlen($trimmedRue) == 1) {
			$ChampsIncorrects['Rue'] = 'Rue';
			$ClassRue = 'error';
		} else if (strlen($trimmedRue) >= 2) {
			$rue = $trimmedRue;
		}
	}

	if (isset($_POST['codePostal'])) {
		$trimmedCodePostal = trim($_POST['codePostal']);
		if (strlen($trimmedCodePostal) > 0) {
			if (strlen($trimmedCodePostal) != 5) {
				$ChampsIncorrects['CodePostal'] = 'CodePostal';
				$ClassCodePostal = 'error';
			} else {
				$codePostal = $trimmedCodePostal;
			}
		}
	}

	if (isset($_POST['ville'])) {
		$trimmedVille = $_POST['ville'];
		if ($trimmedVille != "") {
			if (strlen($trimmedVille) < 2) {
				$ChampsIncorrects['Ville'] = 'Ville';
				$ClassVille = 'error';
			} else {
				$ville = $trimmedVille;
			}
		}
	}
}
