<?php 
session_start();
include("Donnees.inc.php");
if (isset($_POST["action"])) {
    if (isset($_POST["cocktailId"]) && isset($Recettes[$_POST["cocktailId"]])) {
        $cocktailId = $_POST["cocktailId"];
        $utilisateurs = json_decode(file_get_contents("DonneesUtilisateurs.json"), true);
        if ($_POST["action"] == "ajouter") {
            if ((isset($_SESSION["utilisateur"])) && (!isset($utilisateurs[$_SESSION["utilisateur"]]["recettes"][$cocktailId]))) {
                $utilisateurs[$_SESSION["utilisateur"]]["recettes"][strval($cocktailId)] = $cocktailId;
            }
            $_SESSION["MesRecettes"][strval($cocktailId)] = $cocktailId;
        }
        else if ($_POST["action"] == "enlever") {
            if (isset($_SESSION["utilisateur"]) && (isset($utilisateurs[$_SESSION["utilisateur"]]["recettes"][$cocktailId]))) {
                unset($utilisateurs[$_SESSION["utilisateur"]]["recettes"][strval($cocktailId)]);
            }
            unset($_SESSION["MesRecettes"][strval($cocktailId)]);
            
        }
        file_put_contents("DonneesUtilisateurs.json", json_encode($utilisateurs), LOCK_EX);
        echo implode(" , ", $_SESSION["MesRecettes"]);
    }
}
?>