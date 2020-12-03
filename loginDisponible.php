<?php 
$utilisateurs = json_decode(file_get_contents("DonneesUtilisateurs.json"), true);
header('Content-type: text/html; charset=iso-8859-1');
$login = $_GET["login"];
if (array_key_exists($login, $utilisateurs))
    echo "Login n'est plus disponible.";
else
    echo "";
?>