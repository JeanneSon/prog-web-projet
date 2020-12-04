<?php 
session_start();
/**
 * communique avec utilisateurOptions.php
 * revoie le bon chemin selon l'action que l'utilisateuer a choisi
 */
if (isset($_POST["action"])) {
    $reponse = "ok";
    $action = $_POST["action"];
    if ($action == "deconnexion") {
        if (!isset($_SESSION["utilisateur"])) {
            $reponse = "erreur";
        } else {
            unset($_SESSION["utilisateur"]);
            unset($_SESSION["MesRecettes"]);
            $reponse = "index.php";
        }
    } else if ($action == "modification") {
        $reponse = "index.php?page=compte-detail";
    } else if ($action == "suppression") {
        if (!isset($_SESSION["utilisateur"])) {
            $reponse = "erreur";
        } else {
            $utilisateurs = json_decode(file_get_contents("DonneesUtilisateurs.json"), true);
            unset($utilisateurs[$_SESSION["utilisateur"]]);
            file_put_contents("DonneesUtilisateurs.json", json_encode($utilisateurs), LOCK_EX);
            unset($_SESSION["utilisateur"]);
            $reponse = "index.php";
            if (isset($_SESSION["MesRecettes"])) {
                unset($_SESSION["MesRecettes"]);
            }
        }
    } else if ($action == "connexion") {
        $reponse = "index.php?page=identification_form";
    } else if ($action == "creation") {
        $reponse = "index.php?page=compte-detail";
    } 
    echo $reponse;
}


/**
 * checker si le login est encore disponible
 * renvoie le message d'erreur qui sera affiché à l'utilisateur
 */
if (isset($_GET["login"])) {
    $utilisateurs = json_decode(file_get_contents("DonneesUtilisateurs.json"), true);
    header('Content-type: text/html; charset=iso-8859-1');
    $login = $_GET["login"];
    if (array_key_exists($login, $utilisateurs))
        echo "Login n'est plus disponible.";
    else
        echo "";
}


/**
 * checker si l'utilisateur est connecté
 * si oui : renvoyer les données de l'utilisateur (format: champs:::valeur;;;champs:::valeur)
 * si non : revoyer "non connecté"
 */
if (isset($_POST["connecte"])) {
    if (isset($_SESSION["utilisateur"])) {
        $utilisateurs = json_decode(file_get_contents("DonneesUtilisateurs.json"), true);
        if (isset($utilisateurs[$_SESSION["utilisateur"]])) {
            $reponse = ["login...".$_SESSION["utilisateur"]];
            foreach ($utilisateurs[$_SESSION["utilisateur"]] as $champ => $valeur) {
                if ($champ != "recettes") {
                    array_push($reponse, $champ."...".$valeur);
                }
            }
            echo implode(";;;", $reponse);
        }
    } else {
        echo "non connecté";
    }
}

/**
 * checker si la combinaison de login et mot de passe est valide
 * si oui : renvoyer "ok"
 * si non : renvoyer "erreur"
 */
if (isset($_POST["login"]) && isset($_POST["mdp"])) {
    $utilisateurs = json_decode(file_get_contents("DonneesUtilisateurs.json"), true);
    header('Content-type: text/html; charset=iso-8859-1');
    $reponse = "erreur";
    if (array_key_exists($_POST["login"], $utilisateurs) && array_key_exists("mdp", $utilisateurs[$_POST["login"]])) {
        if ($utilisateurs[$_POST["login"]]["mdp"] == $_POST["mdp"]) {
            $reponse = "ok";
            $_SESSION['utilisateur'] = $_POST["login"];
            if (isset($_SESSION["MesRecettes"])) {
                $utilisateurs[$_SESSION["utilisateur"]]["recettes"] = array_merge($_SESSION["MesRecettes"], $utilisateurs[$_SESSION["utilisateur"]]["recettes"]);
                file_put_contents("DonneesUtilisateurs.json", json_encode($utilisateurs), LOCK_EX);
            }
            $_SESSION["MesRecettes"] = $utilisateurs[$_SESSION["utilisateur"]]["recettes"];
        }
    }
    echo $reponse;
}
?>