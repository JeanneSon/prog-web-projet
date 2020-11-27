<?php 
$utilisateurs = json_decode(file_get_contents("DonneesUtilisateurs.json"), true);
$ClassLogin = 'ok';
$ClassMdp = 'ok';
$LoginSucces = true;
if (isset($_POST['submit'])) {
    $LoginSucces = false;
    $ClassLogin = 'error';
    $ClassMdp = 'error';
    if (isset($_POST['login']) && isset($_POST['mdp'])) {
        $trimmedUtilisateur = trim($_POST['login']);
        if (isset($utilisateurs[$trimmedUtilisateur])) {
            if (isset($utilisateurs[$trimmedUtilisateur]['mdp'])) {
                if ($utilisateurs[$trimmedUtilisateur]['mdp'] == trim($_POST['mdp'])) {
                    $ClassLogin = "ok";
                    $ClassMdp = "ok";
                    $LoginSucces = true;
                }
            }
        }
    }
}
?>