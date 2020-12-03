<?php
    session_start();

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

    $ChampsIncorrects['login'] = 'Login';
    if (isset($_POST['login'])) {
        $trimmedLogin = trim($_POST['login']);
        if (strlen($trimmedLogin) > 1) {
            unset($ChampsIncorrects['login']);
            $login = $trimmedLogin;
        } else {
            $ChampsIncorrects['login'] = $_POST['login'];
        }
    }

    $ChampsIncorrects['mdp'] = 'mdp';
    if (isset($_POST['mdp'])) {
        $trimmedMdp = trim($_POST['mdp']);
        if (strlen($trimmedMdp) > 1) {
            unset($ChampsIncorrects['mdp']);
            $mdp = $trimmedMdp;
        } else {
            $ChampsIncorrects['mdp'] = $_POST['mdp'];
        }
    }

    if (isset($_POST['nom'])) {
        $trimmedNom = trim($_POST['nom']);
        if (strlen($trimmedNom) == 1) {
            $ChampsIncorrects['nom'] = $_POST['nom'];
        } else if (strlen($trimmedNom) > 1) {
            $nom = $trimmedNom;
        }
    }


    if (isset($_POST['prenom'])) {
        $trimmedPrenom = trim($_POST['prenom']);
        if (strlen($trimmedPrenom) == 1) {
            $ChampsIncorrects['prenom'] = $_POST['prenom'];
        } else if (strlen($trimmedPrenom) > 1) {
            $prenom = $trimmedPrenom;
        }
    }

    // TODO: check right box in form
    if (isset($_POST['sexe'])) {
        if (!$_POST['sexe'] == "notSet") {
            $trimmedSexe = trim($_POST['sexe']);
            if ($trimmedSexe == "f" || $trimmedSexe == "h") {
                $sexe = $trimmedSexe;
            } else {
                $ChampsIncorrects['sexe'] = $_POST['sexe'];
            }
        }
        
    }

    if (isset($_POST['naissance'])) {
        $trimmedNaissance = trim($_POST['naissance']);
        if ($trimmedNaissance != "") {
            list($Annee, $Mois, $Jour) = explode('-', $trimmedNaissance);
            if (!checkdate($Mois, $Jour, $Annee)) {
                $ChampsIncorrects['naissance'] = $_POST['naissance'];
            } else $naissance = $trimmedNaissance;
        } 
    }

    if (isset($_POST['email'])) {
        $trimmedEmail = trim($_POST['email']);
        if (filter_var($trimmedEmail, FILTER_VALIDATE_EMAIL)) {
            $email = $trimmedEmail;
        } else if ($trimmedEmail != "") {
            $ChampsIncorrects['email'] = $_POST['email'];
        }
    }

    if (isset($_POST['telephone'])) {
        $trimmedTelephone = trim($_POST['telephone']);
        if (!$trimmedTelephone == "") {
            if (preg_match("#([0-9]{2}){5}#", $trimmedTelephone)) {
            $telephone = $trimmedTelephone;
            }
            else {
                $ChampsIncorrects['telephone'] = $_POST['telephone'];
            }
        }
    }

    if (isset($_POST['rue'])) {
        $trimmedRue = trim($_POST['rue']);
        if (strlen($trimmedRue) == 1) {
            $ChampsIncorrects['rue'] = $_POST['rue'];
        } else if (strlen($trimmedRue) >= 2) {
            $rue = $trimmedRue;
        }
    }

    if (isset($_POST['codePostal'])) {
        $trimmedCodePostal = trim($_POST['codePostal']);
        if (strlen($trimmedCodePostal) > 0) {
            if (strlen($trimmedCodePostal) != 5) {
                $ChampsIncorrects['codePostal'] = $_POST['codePostal'];
            } else {
                $codePostal = $trimmedCodePostal;
            }
        }
    }

    if (isset($_POST['ville'])) {
        $trimmedVille = $_POST['ville'];
        if ($trimmedVille != "") {
            if (strlen($trimmedVille) < 2) {
                $ChampsIncorrects['ville'] = $_POST['ville'];
            } else {
                $ville = $trimmedVille;
            }
        }
    }

    if (empty($ChampsIncorrects)) {
        $utilisateurs = json_decode(file_get_contents("DonneesUtilisateurs.json"), true);
        if (isset($_SESSION["utilisateur"])) {
            if ($login != $_SESSION["utilisateur"]) {
                unset($utilisateurs[$_SESSION["utilisateur"]]);
            }
        }
        $_SESSION["utilisateur"] = $login;
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
            "recettes" => $_SESSION["MesRecettes"] 
        ];
        file_put_contents("DonneesUtilisateurs.json", json_encode($utilisateurs), LOCK_EX);
        echo "ok";
    } else {
        echo implode(";;;", array_keys($ChampsIncorrects));
    }


?>