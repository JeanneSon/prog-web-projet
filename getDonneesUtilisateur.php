<?php
session_start();
if (isset($_SESSION["utilisateur"])) {
    $utilisateurs = json_decode(file_get_contents("DonneesUtilisateurs.json"), true);
    if (isset($utilisateurs[$_SESSION["utilisateur"]])) {
        $reponse = ["login...".$_SESSION["utilisateur"]];
        foreach ($utilisateurs[$_SESSION["utilisateur"]] as $champ => $valeur) {
            if ($champ != "recettes") {
                //format: champs:::valeur;;;champs:::valeur
                array_push($reponse, $champ."...".$valeur);
            }
        }
        echo implode(";;;", $reponse);
    }
} else {
    echo "non connecté";
}
?>