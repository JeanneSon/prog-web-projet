<h2 style="position:absolute;left: 20%; top: 15px;font-size:larger;display: inline;">Cocktails Préférés</h2>
<?php 
$affichageRecettes = $_SESSION["MesRecettes"];
if (isset($_SESSION["utilisateur"])) {
    $affichageRecettes  = array_unique(array_merge($affichageRecettes, $utilisateurs[$_SESSION["utilisateur"]]["recettes"]));
}
if (!empty($affichageRecettes)) {
    echo "<ul>\n";
    foreach ($affichageRecettes as $recetteId) {
        if (isset($Recettes[$recetteId])) {
            echo "<li><a href='?page=cocktail-detail&cocktailId=".$recetteId."'>".$Recettes[$recetteId]['titre']."</a></li>\n";
        }
    }
    echo "</ul>";
} else
    echo "<p>Vous n'avez pas encore des cocktails préférés.</p>";
?>