<?php 
session_start();
$utilisateurs = json_decode(file_get_contents("DonneesUtilisateurs.json"), true);
header('Content-type: text/html; charset=iso-8859-1');
$reponse = "erreur";
if (isset($_POST["login"]) && isset($_POST["mdp"])) {
    if (array_key_exists($_POST["login"], $utilisateurs) && array_key_exists("mdp", $utilisateurs[$_POST["login"]])) {
        if ($utilisateurs[$_POST["login"]]["mdp"] == $_POST["mdp"]) {
            $reponse = "ok";
            $_SESSION['utilisateur'] = $_POST["login"];
        }
    }
}
echo $reponse;
?>
