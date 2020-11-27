<?php
//TODO - change logic of telephone, email
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

// comment stocker les données
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
	$ChampsIncorrects = '';

	if ((!isset($_POST['login'])) || strlen($login = trim($_POST['login'])) < 2) {
		$ChampsIncorrects = $ChampsIncorrects . 'Login, ';
		$ClassLogin = 'error';
	}

	if ((!isset($_POST['mdp'])) || strlen($mdp = trim($_POST['mdp'])) < 2) {
		$ChampsIncorrects = $ChampsIncorrects . 'Mot de passe, ';
		$ClassMdp = 'error';
	}

	if ((!isset($_POST['nom'])) || (strlen($nom = trim($_POST['nom'])) < 2)) {
		if (trim($_POST['nom']) != '') {
			$ChampsIncorrects = $ChampsIncorrects . 'Nom, ';
			$ClassNom = 'error';
		}
	}

	if (!isset($_POST['prenom']) || (strlen($prenom = trim($_POST['prenom'])) < 2)) {
		if (trim($_POST['prenom']) != '') {
			$ChampsIncorrects = $ChampsIncorrects . 'Prénom, ';
			$ClassPrenom = 'error';
		}
	}

	if ((isset($_POST['sexe'])) && ($sexe = (trim($_POST['sexe']) != 'f') && (trim($_POST['sexe']) != 'h'))) {
		$ChampsIncorrects = $ChampsIncorrects . 'Sexe, ';
		$ClassSexe = 'error';
	}

	if ((!isset($_POST['naissance'])) || (trim($_POST['naissance']) == '')) {
		$ClassNaissance = 'ok';
	} else if (isset($_POST['naissance'])) {
		list($Annee, $Mois, $Jour) = explode('-', $_POST['naissance']);
		if (!checkdate($Mois, $Jour, $Annee)) {
			$ChampsIncorrects = $ChampsIncorrects . 'Date de naissance, ';
			$ClassNaissance = 'error';
		} else $naissance = $_POST['naissance'];
	}
	if ((!isset($_POST['email']) || (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)))) {
		if (trim($_POST['email']) != '') {
			$ChampsIncorrects = $ChampsIncorrects . 'Adresse électronique, ';
			$ClassEmail = 'error';
		}
	}
	if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$email = $_POST['email'];
	}

	if ((!isset($_POST['telephone'])) || (!preg_match("#([0-9]{2}){5}#", $_POST['telephone']))) {
		if (trim($_POST['telephone']) != '') {
			$ChampsIncorrects = $ChampsIncorrects . 'Numéro de telephone, ';
			$ClassTelephone = 'error';
		} 
	}
	if (isset($_POST['telephone']) && preg_match("#([0-9]{2}){5}#", $_POST['telephone'])) {
		$telephone = $_POST['telephone'];
	}

	if (isset($_POST['rue'])) {
		$trimmedRue = trim($_POST['rue']);
		if (strlen($trimmedRue) == 1) {
			$ChampsIncorrects = $ChampsIncorrects . 'Rue, ';
			$ClassRue = 'error';
		} else if (strlen($trimmedRue) >= 2) {
			$rue = $trimmedRue;
		}
	}

	if (isset($_POST['codePostal'])) {
		$trimmedCodePostal = trim($_POST['codePostal']);
		if (strlen($trimmedCodePostal) > 0) {
			if (strlen($trimmedCodePostal) != 5) {
				$ChampsIncorrects = $ChampsIncorrects . 'CodePostal, ';
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
				$ChampsIncorrects = $ChampsIncorrects . 'Ville';
				$ClassVille = 'error';
			} else {
				$ville = $trimmedVille;
			}
		}
	}
}
