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
        $reponse = "index.php?page=page_identification";
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
?>